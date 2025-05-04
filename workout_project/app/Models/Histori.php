<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Histori extends Model
{
    use HasFactory;

    protected $connection = 'mongodb'; // pastikan ini disetel

    protected $collection = 'historis'; // optional: jika nama koleksi berbeda dari nama model

    protected $fillable = [
        'durasi', 'repetisi', 'kesulitan', 'catatan', 'id_user', 'id_result'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function result()
    {
        return $this->belongsTo(Result::class, 'id_result');
    }
}
