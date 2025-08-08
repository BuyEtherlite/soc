<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsurancePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'base_premium',
        'coverage_amount',
        'deductible',
        'terms',
        'required_fields',
        'is_active',
    ];

    protected $casts = [
        'base_premium' => 'decimal:2',
        'coverage_amount' => 'decimal:2',
        'deductible' => 'decimal:2',
        'required_fields' => 'array',
        'terms' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get all policies for this package
     */
    public function policies()
    {
        return $this->hasMany(InsurancePolicy::class);
    }
}