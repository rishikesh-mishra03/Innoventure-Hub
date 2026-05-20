<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // startup, corporate, investor, mentor, admin
        'avatar',
        'bio',
        'location',
        'website',
        'linkedin',
        'twitter',
        'github',
        'phone',
        'is_verified',
        'is_active',
        'two_factor_enabled',
        'kyc_status', // pending, verified, rejected
        'company_verified',
        'profile_complete',
        'last_login_at',
        'settings',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'two_factor_enabled' => 'boolean',
        'company_verified' => 'boolean',
        'profile_complete' => 'boolean',
        'settings' => 'array',
    ];

    public function startup()
    {
        return $this->hasOne(Startup::class, 'user_id');
    }

    public function corporate()
    {
        return $this->hasOne(Corporate::class, 'user_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStartup()
    {
        return $this->role === 'startup';
    }

    public function isCorporate()
    {
        return $this->role === 'corporate';
    }
}
