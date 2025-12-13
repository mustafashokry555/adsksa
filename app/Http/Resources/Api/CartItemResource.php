<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'price' => $this->price ? (float)$this->price : $this->price,
            'vat' => $this->vat ? (float)$this->vat : $this->vat,
            'total' => $this->total ? (float)$this->total : $this->total,
            'appointment' => AppointmentResource::make($this->whenLoaded('appointment')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}

