<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // ✅ Pakai model MongoDB

class Workout extends Model
{
    protected $connection = 'mongodb'; // ✅ Wajib
    protected $collection = 'workouts'; // ✅ Nama koleksi di MongoDB

    protected $fillable = [
        'Unnamed: 0',
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
