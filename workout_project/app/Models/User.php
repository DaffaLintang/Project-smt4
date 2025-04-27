<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // Ganti dari Illuminate
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens;

    protected $connection = 'mongodb';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'full_name', 'phone', 'birth', 'weight', 'height', 'image'
    ];

    // Relasi dengan histori
    public function historis()
    {
        return $this->hasMany(Histori::class, 'id_user');
    }

    // Relasi dengan result
    public function results()
    {
        return $this->hasMany(Result::class, 'id_user');
    }
}
