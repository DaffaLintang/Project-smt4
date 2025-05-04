<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // Ganti dari Illuminate
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    public $timestamps = true;

    protected $fillable = [
        'title', 'desc', 'type', 'bodyPart', 'equipment', 'level', 'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function histori()
    {
        return $this->hasOne(Histori::class, 'id_result');
    }
}
