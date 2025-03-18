<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable =  ['id_user','image','full_name', 'email', 'phone', 'birth', 'weight', 'height'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
