<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ResultResource extends JsonResource
{
    public $status;
    public $message;

    public function __construct($resource, $status = null, $message = null)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        // Kalau datanya Collection (banyak data)
        if ($this->resource instanceof Collection) {
            return [
                'success' => $this->status,
                'message' => $this->message,
                'data' => $this->resource->map(function ($result) {
                    return [
                        'id' => $result->_id,
                        'title' => $result->title,
                        'desc' => $result->desc,
                        'type' => $result->type,
                        'bodyPart' => $result->bodyPart,
                        'equipment' => $result->equipment,
                        'level' => $result->level,
                        'user_id' => $result->id_user,
                    ];
                }),
            ];
        }

        // Kalau datanya satuan (single data)
        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => [
                'id' => $this->_id,
                'title' => $this->title,
                'desc' => $this->desc,
                'type' => $this->type,
                'bodyPart' => $this->bodyPart,
                'equipment' => $this->equipment,
                'level' => $this->level,
                'user_id' => $this->id_user,
            ]
        ];
    }
}
