<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientInsuranceResource extends JsonResource
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
            'patient_name' => $this->patient ? $this->patient->name : null,
            'patient_id_number' => $this->patient ? $this->patient->id_number : null,
            'date_of_birth' => $this->patient ? $this->patient->date_of_birth : null,
            'medical_network' => $this->medical_network ?? null,
            'insurance_expiry_date' => $this->insurance_expiry_date ?? null,
            'co_payment_percentage' => $this->co_payment_percentage ?? null,
            'category' => $this->category ?? null,
            'coverage_limits' => $this->coverage_limits ?? null,
            'insurance_policy_number' => $this->insurance_policy_number ?? null,
            'insurance_name' => $this->insurance ? $this->insurance->name : null,
            'subscriber_number' => $this->subscriber_number ?? null,
        ];
    }
}

