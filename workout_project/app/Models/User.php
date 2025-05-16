<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract
{
    use HasApiTokens, Authenticatable, CanResetPassword, Notifiable;

    protected $connection = 'mongodb';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'full_name', 'phone', 'birth', 'weight', 'height', 'image'
    ];

    public function historis()
    {
        return $this->hasMany(Histori::class, 'id_user');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'id_user');
    }
}
