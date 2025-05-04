<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Result extends Model
{
    protected $connection = 'mongodb';
    public $timestamps = true;
    protected $collection = 'results'; // opsional jika nama koleksi default sudah benar

    protected $fillable = [
        'title', 'desc', 'type', 'bodyPart', 'equipment', 'level', 'id_user'
    ];

    // ⚠️ Relasi di bawah ini hanya bersifat konvensional,
    // Anda harus handle query manual jika relasinya tidak jalan

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function histori()
    {
        return $this->hasOne(Histori::class, 'id_result');
    }
}
