<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;

class HospitalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = null;
        if ($request->user()) {
            $user = $request->user();
        }else{
            $token = request()->bearerToken();
            if ($token) {
                $tokenModel = PersonalAccessToken::findToken($token);
                if ($tokenModel) {
                    $user_id = $tokenModel->tokenable->id;
                    $user = User::find($user_id);
                }
            }
        }

        return [
            'id' => $this->id,
            'hospital_name' => $this->hospital_name,
            'hospital_type_id' => $this->hospitalType ? (int)$this->hospitalType->id : null,
            'hospital_type_name' => $this->hospitalType ? $this->hospitalType->name : null,
            'avg_rating' =>  (float)$this->avg_rating,
            'rating_count' =>  (int)$this->rating_count,
            'image' => $this->image,
            'country' => $this->country ? $this->country->name : null,
            'state' => $this->state ? $this->state->name : null,
            'city' => $this->city ? $this->city->name : null,
            'lat' => $this->lat ? (float)$this->lat : $this->lat,
            'long' => $this->long ? (float)$this->long : $this->long,
            'distance' => $this->distance ? (float)$this->distance : null,
            'location' => $this->location,
            'images_links' => $this->images_links,
            'is_favorite' => $user ? $user->isFavoriteHospital($this->id) : false,
        ];
    }


}
