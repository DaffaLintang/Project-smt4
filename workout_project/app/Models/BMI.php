<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class BMI extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'obesity';

    // HAPUS atau komen bagian berikut:
    // protected $primaryKey = '_id';
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'Age',
        'Gender',
        'Height',
        'Weight',
        'BMI',
        'PhysicalActivityLevel',
        'ObesityCategory'
    ];
}