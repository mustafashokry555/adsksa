<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    protected $fillable = ['name_en', 'name_ar', 'email', 'user_id', 'address', 'phone1', 'city', 'phone2', 'state', 'fax'];
    protected $appends = ['name'];

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }

    public function patients()
    {
        return $this->hasManyThrough(User::class, PatientInsurance::class, 'insurance_id', 'id', 'id', 'patient_id')
            ->where('users.type', User::PATIENT);
    }
    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->name_ar != NULL) {
            return $this->name_ar;
        }
        return $this->name_en;
    }
}
