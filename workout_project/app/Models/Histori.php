<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\BSON\Regex;

class Histori extends Model
{
    use HasFactory;

    protected $connection = 'mongodb'; // pastikan ini disetel

    protected $collection = 'historis'; // optional: jika nama koleksi berbeda dari nama model

    protected $fillable = [
        'durasi', 'repetisi', 'kesulitan', 'catatan', 'id_user', 'id_result'
    ];

    // Pastikan field yang bisa dicari
    protected $searchable = [
        'durasi',
        'repetisi',
        'kesulitan',
        'catatan',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function result()
    {
        return $this->belongsTo(Result::class, 'id_result');
    }

    // Method untuk pencarian
    public static function search($search)
    {
        if (empty($search)) {
            return static::query();
        }

        $searchTerm = new Regex($search, 'i');
        
        return static::raw(function($collection) use ($searchTerm) {
            return $collection->aggregate([
                [
                    '$match' => [
                        '$or' => [
                            ['durasi' => $searchTerm],
                            ['repetisi' => $searchTerm],
                            ['kesulitan' => $searchTerm],
                            ['catatan' => $searchTerm],
                            ['id_user' => $searchTerm]
                        ]
                    ]
                ],
                [
                    '$sort' => ['created_at' => -1]
                ]
            ])->toArray();
        });
    }
}
