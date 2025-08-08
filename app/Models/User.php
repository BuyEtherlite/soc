<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'referral_code',
        'referred_by',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is an administrator
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Generate unique referral code
     */
    public static function generateReferralCode(): string
    {
        do {
            $code = strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('referral_code', $code)->exists());
        
        return $code;
    }

    /**
     * Get the user who referred this user
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    /**
     * Get users referred by this user
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    /**
     * Get insurance policies owned by this user
     */
    public function insurancePolicies()
    {
        return $this->hasMany(InsurancePolicy::class);
    }

    /**
     * Get commissions earned by this user
     */
    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    /**
     * Get current rank of this user
     */
    public function currentRank()
    {
        return $this->hasOne(UserRank::class)->where('is_current', true)->with('rank');
    }

    /**
     * Get all ranks achieved by this user
     */
    public function ranks()
    {
        return $this->hasMany(UserRank::class);
    }

    /**
     * Get MLM children (left and right leg)
     */
    public function mlmChildren()
    {
        return $this->hasMany(User::class, 'mlm_parent_id');
    }

    /**
     * Get MLM parent
     */
    public function mlmParent()
    {
        return $this->belongsTo(User::class, 'mlm_parent_id');
    }
}
