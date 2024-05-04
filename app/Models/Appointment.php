<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id','insurance_id', 'patient_id','fee', 'hospital_id', 'appointment_time', 'status', 'appointment_date','cancel_by_patient'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient(){
        return $this->belongsTo(User::class,'patient_id');
    }

    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }

    public function appointment(){
        return $this->hasOne(Notification::class);
    }
}
