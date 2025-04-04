<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable =  ['title', 'desc', 'type', 'bodyPart', 'equipment', 'level', 'id_user'];

    public function user(){
        return $this->belongsTo(User::class, "id_user");
    }
    public function histori(){
        return $this->hasOne(Histori::class);
    }
}
