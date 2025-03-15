<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;

    protected $fillable =  ['durasi', 'repetisi', 'kesulitan','catatan'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function result(){
        return $this->belongsTo(Result::class);
    }
}
