<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class LoginLog extends Model
{
   protected $connection = 'mongodb';

    protected $fillable = [
        'user_id'
    ];
}
