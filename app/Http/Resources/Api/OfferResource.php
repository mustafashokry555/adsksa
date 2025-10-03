<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title ?? '',
            'content' => $this->content ?? '',
            'type' => $this->type,
            'video_link' =>  $this->video_link,
            'images' => $this->images,
            'hospital_id' => $this->hospital_id ? (int)$this->hospital_id : $this->hospital_id,
            'hospital_name' => $this->hospital->hospital_name ?? '',
            'is_active' => $this->is_active,
            'start_date' => $this->start_date,
            'offer_type' => $this->offerType->name ?? '',
            'end_date' => $this->end_date,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}

