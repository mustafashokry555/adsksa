<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;

class DoctorResource extends JsonResource
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
            'profile_image' => $this->profile_image,
            'name' => $this->name,
            'speciality_name' => $this->speciality->name,
            'avg_rate' => $this->avg_rate ? (float)$this->avg_rate : $this->avg_rate,
            'distance' => $this->distance ? (float)$this->distance : null,
            'hospital_name' => $this->hospital ? $this->hospital->hospital_name : null,
            'pricing' => $this->pricing ? (float)$this->pricing : $this->pricing,
            'is_favorite' => $user ? $user->isFavoriteDoctor($this->id) : false,
            'degree' => $this->degree ?  DegreeResource::make($this->degree) : null,
            'currency' => $this->currency ?  CurrancyResource::make($this->currency) : null,
        ];
    }


}
