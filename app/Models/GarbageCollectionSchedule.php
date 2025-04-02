<?php

// app/Models/GarbageCollectionSchedule.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GarbageCollectionSchedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'barangay_id',
        'collection_date',
        'collection_time',
        'status',
    ];

    protected $casts = [
        'collection_date' => 'date',
        'collection_time' => 'datetime',
    ];

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class, 'barangay_id', 'barangay_id');
    }

    public function wasteCollectionRecords(): HasMany
    {
        return $this->hasMany(WasteCollectionRecord::class, 'schedule_id', 'schedule_id');
    }
}
