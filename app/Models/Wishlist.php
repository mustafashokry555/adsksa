<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable =['doctor_id','patient_id', 'hospital_id', 'status'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')->where('user_type', User::DOCTOR);
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id')->where('user_type', User::PATIENT);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
