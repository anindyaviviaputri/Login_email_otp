<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Hapus OTP codes saat user dihapus
        static::deleting(function($user) {
            $user->otpCode()->delete();
        });
    }

    public function otpCode()
    {
        return $this->hasOne(OtpCode::class);
    }
}