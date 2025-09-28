<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'otp',
        'expires_at',
        'is_used',
        'reason',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used'    => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Scope to check valid OTPs (not expired and not used)
    public function scopeValid(Builder $query): Builder
    {
        return $query->where('is_used', false)
            ->where('expires_at', '>=', Carbon::now());
    }

    // Scope for expired OTPs
    public function scopeExpired(Builder $query): Builder
    {
        return $query->where('expires_at', '<', Carbon::now());
    }

    // Scope for OTPs of a specific email
    public function scopeForEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', $email);
    }

    // Scope for OTPs of a specific user
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    // Scope for OTPs with a specific reason (e.g. 'email_verification', 'password_reset')
    public function scopeForReason(Builder $query, string $reason): Builder
    {
        return $query->where('reason', $reason);
    }
}
