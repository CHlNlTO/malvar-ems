<?php

// app/Models/EnvironmentalClearance.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnvironmentalClearance extends Model
{
    use HasFactory;

    protected $primaryKey = 'clearance_id';

    protected $fillable = [
        'company_id',
        'submission_date',
        'status',
        'remarks',
        'document',
    ];

    protected $casts = [
        'submission_date' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }
}
