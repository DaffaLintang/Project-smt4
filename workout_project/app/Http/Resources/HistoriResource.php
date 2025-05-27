<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoriResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->_id,
            'durasi' => $this->durasi,
            'repetisi' => $this->repetisi,
            'kesulitan' => $this->kesulitan,
            'catatan' => $this->catatan,
            'result' => new ResultResource($this->result),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function with(Request $request): array
    {
        return [
            'success' => true,
            'message' => 'List Histori Workout'
        ];
    }
}
