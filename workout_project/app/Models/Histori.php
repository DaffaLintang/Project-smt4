<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;

    protected $fillable =  ['durasi', 'repetisi', 'kesulitan','catatan', "id_user", "id_result"];

    public function user(){
        return $this->belongsTo(User::class, "id_user");
    }

    public function result(){
        return $this->belongsTo(Result::class, "id_result");
    }

    
}
