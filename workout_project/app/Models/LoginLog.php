<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class LoginLog extends Model
{
   protected $connection = 'mongodb';
   protected $collection = 'login_logs';

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
