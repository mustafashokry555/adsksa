<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\PersonalAccessToken;

class DoctorProfileResource extends JsonResource
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
            'name' => $this->name,
            'profile_image' => $this->profile_image,
            'avg_rate' => $this->avg_rate ? (float)$this->avg_rate : $this->avg_rate,
            'reviews_count' => (int)$this->rating_count,
            'is_favorite' => $user ? $user->isFavoriteDoctor($this->id) : false,
            'gender' => $this->gender,
            'pricing' => $this->pricing ? (float)$this->pricing : $this->pricing,
            'distance' => $this->distance ? (float)$this->distance : null,
            'degree' => $this->degree ?  DegreeResource::make($this->degree) : null,
            'currency' => $this->currency ?  CurrancyResource::make($this->currency) : null,
            'hospital_id' => $this->hospital_id,
            'speciality_id' => $this->speciality_id,
            'hospital' => $this->hospital ? HospitalResource::make($this->hospital) : null,
            'speciality' => $this->speciality ? [
                'id' => $this->speciality->id,
                'name' => $this->speciality->name,
            ] : null,
        ];
    }

}
