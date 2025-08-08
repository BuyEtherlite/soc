<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsurancePolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'insurance_package_id',
        'policy_number',
        'status',
        'premium_amount',
        'coverage_customizations',
        'user_provided_data',
        'start_date',
        'end_date',
        'next_payment_date',
    ];

    protected $casts = [
        'premium_amount' => 'decimal:2',
        'coverage_customizations' => 'array',
        'user_provided_data' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'next_payment_date' => 'date',
    ];

    /**
     * Get the user who owns this policy
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the insurance package this policy is based on
     */
    public function package()
    {
        return $this->belongsTo(InsurancePackage::class, 'insurance_package_id');
    }

    /**
     * Get all claims for this policy
     */
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    /**
     * Generate unique policy number
     */
    public static function generatePolicyNumber(): string
    {
        do {
            $number = 'POL-' . date('Y') . '-' . strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('policy_number', $number)->exists());
        
        return $number;
    }
}