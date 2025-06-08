<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialRecyclingFacility extends Model
{
    use HasFactory;

    protected $primaryKey = 'mrf_id';

    protected $fillable = [
        'name',
        'location',
        'barangay_id',
        'capacity',
        'status',
        'description',
    ];

    protected $casts = [
        'capacity' => 'decimal:2',
    ];

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class, 'barangay_id', 'barangay_id');
    }

    public function wasteCollectionRecords(): HasMany
    {
        return $this->hasMany(WasteCollectionRecord::class, 'mrf_id', 'mrf_id');
    }

    public function getUtilizationPercentageAttribute(): float
    {
        if ($this->capacity <= 0) {
            return 0;
        }

        $dailyWaste = $this->wasteCollectionRecords()
            ->join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->whereDate('garbage_collection_schedules.collection_date', today())
            ->sum('waste_collection_records.total_volume');

        return ($dailyWaste / $this->capacity) * 100;
    }

    public function getAverageUtilizationAttribute($startDate = null, $endDate = null): float
    {
        if ($this->capacity <= 0) {
            return 0;
        }

        $startDate = $startDate ?? now()->subDays(30);
        $endDate = $endDate ?? now();

        $totalWaste = $this->wasteCollectionRecords()
            ->join('garbage_collection_schedules', 'waste_collection_records.schedule_id', '=', 'garbage_collection_schedules.schedule_id')
            ->whereBetween('garbage_collection_schedules.collection_date', [$startDate, $endDate])
            ->sum('waste_collection_records.total_volume');

        $daysDifference = \Carbon\Carbon::parse($startDate)->diffInDays(\Carbon\Carbon::parse($endDate)) + 1;
        $avgDailyWaste = $daysDifference > 0 ? $totalWaste / $daysDifference : 0;

        return ($avgDailyWaste / $this->capacity) * 100;
    }
}
