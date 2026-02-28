<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_AFFILIATE = 'affiliate';

    protected $fillable = [
        'name',
        'whatsapp_phone',
        'password',
        'role',
        'status',
        'referral_code',
        'commission_rate',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'affiliate_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
}
