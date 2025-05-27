<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class UserLog extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'user_id',
        'activity',
        'created_at'
    ];
} 