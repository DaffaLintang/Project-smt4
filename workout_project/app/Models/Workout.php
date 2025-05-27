<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // ✅ Pakai model MongoDB

class Workout extends Model
{
    protected $connection = 'mongodb'; // ✅ Wajib
    protected $collection = 'workouts'; // ✅ Nama koleksi di MongoDB
    protected $primaryKey = '_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Title',
        'Desc',
        'Type',
        'BodyPart',
        'Equipment',
        'Level',
        'Rating',
        'RatingDesc'
    ];
}
