<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // ✅ PAKAI ELOQUENT MYSQL


class Workout extends Model
{
    use HasFactory;

    protected $table = 'workouts'; // Nama tabel di database

    protected $fillable = ['Unnamed: 0',
        'title',
        'desc',
        'type',
        'bodypart',
        'equipment',
        'level',
        'rating',
        'rating_desc'
    ];
}
