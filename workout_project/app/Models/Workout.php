<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $collection = 'workouts';
    protected $fillable =  ['Title', 'Desc', 'Type', 'BodyPart', 'Equipment', 'Level', 'Rating'];
}
