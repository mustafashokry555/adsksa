<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    protected $fillable = ['name_en', 'name_ar', 'email', 'user_id', 'address', 'phone1', 'phone2', 'fax', 'country_id', 'state_id', 'city_id'];
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
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->name_ar != NULL) {
            return $this->name_ar;
        }
        return $this->name_en;
    }
}
