<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'insurance_policy_id',
        'claim_number',
        'type',
        'description',
        'incident_date',
        'claim_amount',
        'status',
        'supporting_documents',
        'admin_notes',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'incident_date' => 'date',
        'claim_amount' => 'decimal:2',
        'supporting_documents' => 'array',
        'processed_at' => 'datetime',
    ];

    /**
     * Get the insurance policy this claim belongs to
     */
    public function policy()
    {
        return $this->belongsTo(InsurancePolicy::class, 'insurance_policy_id');
    }

    /**
     * Get the admin who processed this claim
     */
    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Generate unique claim number
     */
    public static function generateClaimNumber(): string
    {
        do {
            $number = 'CLM-' . date('Y') . '-' . strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('claim_number', $number)->exists());
        
        return $number;
    }
}