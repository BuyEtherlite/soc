<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'requirements',
        'monthly_salary',
        'commission_percentage',
        'benefits',
        'is_active',
    ];

    protected $casts = [
        'requirements' => 'array',
        'monthly_salary' => 'decimal:2',
        'commission_percentage' => 'decimal:2',
        'benefits' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get all users with this rank
     */
    public function users()
    {
        return $this->hasMany(UserRank::class);
    }
}