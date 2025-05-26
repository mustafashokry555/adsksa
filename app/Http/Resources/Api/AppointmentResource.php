<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $status = null;
        switch ($this->status) {
            case 'P':
                $status = 'Pending';
                break;

            case 'C':
                $status = 'Confirmed';
                break;

            case 'U':
                $status = 'Cancelled By Patient';
                break;

            case 'D':
                $status = 'Cancelled By Doctor';
                break;

            default:
                $status = null;
                break;
        }

        $gender = null;
        if($this->patient){
            switch ($this->patient->gender) {
                case 'M':
                    $gender = 'Male';
                    break;
                case 'F':
                    $gender = 'Female';
                    break;
                default:
                    $gender = null;
                    break;
            }
        }

        return [
            'id' => $this->id,
            'fee' => $this->fee ? (float)$this->fee : $this->fee,
            'date' => $this->appointment_date,
            'time' => $this->appointment_time,
            'day' => $this->appointment_date ? date('l', strtotime($this->appointment_date)) : '',
            'status' => $status,
            'patient_name' => $this->patient?->name,
            'patient_gender' => $gender,
            'patient_age' => $this->patient?->age,
            'hospital_name' => $this->hospital?->hospital_name,
            'doctor' => $this->doctor ? DoctorResource::make($this->doctor) : null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}

