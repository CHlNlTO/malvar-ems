<?php

// app/Models/Barangay.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Barangay extends Model
{
    use HasFactory;

    protected $primaryKey = 'barangay_id';

    protected $fillable = [
        'name',
        'population',
        'area',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'barangay_id', 'barangay_id');
    }

    public function collectionSchedules(): HasMany
    {
        return $this->hasMany(GarbageCollectionSchedule::class, 'barangay_id', 'barangay_id');
    }

    public function officials(): HasMany
    {
        return $this->hasMany(Official::class, 'barangay_id', 'barangay_id');
    }

    public function materialRecyclingFacilities(): HasMany
    {
        return $this->hasMany(MaterialRecyclingFacility::class, 'barangay_id', 'barangay_id');
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->name);
    }

    // Calculate population density
    public function getPopulationDensityAttribute(): float
    {
        if ($this->area <= 0) {
            return 0;
        }

        return round($this->population / $this->area, 2);
    }
}
