<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Eloquent implements AuthenticatableContract
{
    use HasApiTokens, Authenticatable;

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
