<?php

// app/Models/WasteCollectionRecord.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WasteCollectionRecord extends Model
{
    use HasFactory;

    protected $primaryKey = 'record_id';

    protected $fillable = [
        'schedule_id',
        'biodegradable_volume',
        'non_biodegradable_volume',
        'hazardous_volume',
        'total_volume',
        'collector_id',
        'mrf_id',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(GarbageCollectionSchedule::class, 'schedule_id', 'schedule_id');
    }

    public function collector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'collector_id');
    }

    public function materialRecyclingFacility(): BelongsTo
    {
        return $this->belongsTo(MaterialRecyclingFacility::class, 'mrf_id', 'mrf_id');
    }
}
