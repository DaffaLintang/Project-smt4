<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $table = 'users'; // Pastikan sesuai dengan nama tabel di MySQL
    protected $connection = 'mysql'; // Gunakan MySQL
    protected $fillable = [
        'name',
        'email',
        'password',
        'image','full_name',
        'phone',
        'birth',
        'weight',
        'height'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];



    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function result(){
        return $this->hasOne(Result::class);
    }

    public function histori(){
        return $this->hasOne(Histori::class);
    }
}
