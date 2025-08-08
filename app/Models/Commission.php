<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_user_id',
        'type',
        'amount',
        'source_policy_id',
        'level',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    /**
     * Get the user who earned this commission
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user whose action generated this commission
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Get the policy that generated this commission
     */
    public function sourcePolicy()
    {
        return $this->belongsTo(InsurancePolicy::class, 'source_policy_id');
    }
}