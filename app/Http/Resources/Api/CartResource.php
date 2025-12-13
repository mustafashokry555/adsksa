<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $long = null;
        $lat = null;
        $address = null;
        if ($this->hospital) {
            $long = $this->hospital->long;
            $lat = $this->hospital->lat;
            $address = $this->hospital->location;
        }

        return [
            'id' => $this->id,
            'user_id' => $this->user_id ? (int)$this->user_id : $this->user_id,
            'total' => $this->total ? (float)$this->total : $this->total,
            'items' => CartItemResource::collection($this->whenLoaded('items')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}

