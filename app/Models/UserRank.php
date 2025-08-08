<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rank_id',
        'achieved_at',
        'is_current',
    ];

    protected $casts = [
        'achieved_at' => 'date',
        'is_current' => 'boolean',
    ];

    /**
     * Get the user this rank belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rank
     */
    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }
}