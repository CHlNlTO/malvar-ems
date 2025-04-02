<?php

// app/Models/Barangay.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
