<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;

    protected $connection = 'mongodb'; // Pastikan ini menggunakan MongoDB
    protected $collection = 'users';   // Nama koleksi di MongoDB

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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

    public function profile(){
        return $this->hasMany(Profile::class);
    }
}
