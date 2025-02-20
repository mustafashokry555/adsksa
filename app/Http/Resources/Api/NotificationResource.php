<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from_id' => $this->from_id,
            'to_id' => $this->to_id,
            'title' => $this->title ?? '',
            'message' => $this->message ?? '',
            'isRead' => $this->isRead,
            'notifiable_type' => $this->notifiable_type ? class_basename($this->notifiable_type) : null,
            'notifiable_id' => $this->notifiable_id,
            'time_ago' => $this->created_at->diffForHumans(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}

