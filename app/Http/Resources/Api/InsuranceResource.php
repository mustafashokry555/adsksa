<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InsuranceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'user_id' => (int)$this->user_id ?? '',
            'name' => (string)$this->name ?? '',
            'address' => (string)$this->address ?? '',
            'phone1' => (string)$this->phone1 ?? '',
            'phone2' => (string)$this->phone2 ?? '',
            'fax' => (string)$this->fax ?? '',
            'email' => (string)$this->email ?? '',
            'state_id' => $this->state_id ? (int)$this->state_id : $this->state_id,
            'city_id' => $this->city_id ? (int)$this->city_id : $this->city_id,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : null,
            'updated_at' => $this->updated_at ? Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') : null,
        ];
    }
}
