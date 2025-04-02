<?php

// app/Models/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $primaryKey = 'company_id';

    protected $fillable = [
        'name',
        'industry_type',
        'contact_person',
        'email',
        'phone',
    ];

    public function environmentalClearances(): HasMany
    {
        return $this->hasMany(EnvironmentalClearance::class, 'company_id', 'company_id');
    }
}
