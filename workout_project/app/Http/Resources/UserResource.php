<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $status;
    public $message;

    public function __construct($resource, $status = null, $message = null)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => $this->formatUserData($this->resource),
        ];
    }

    /**
     * Format the user data.
     *
     * @param  \App\Models\User|null  $user
     * @return array|null
     */
    private function formatUserData($user)
    {
        // Cek dulu, kalau null kembalikan null
        if (is_null($user)) {
            return null;
        }

        // Kalau tidak null, baru format datanya
        return [
            'id' => (string) $user->_id, // Pastikan di-cast ke string karena ObjectId
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'image' => $user->image,
            'full_name' => $user->full_name,
            'phone' => $user->phone,
            'birth' => $user->birth,
            'weight' => $user->weight,
            'height' => $user->height,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }
}
