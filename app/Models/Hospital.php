<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'hospital_name_ar',
        'hospital_name_en',
        'address',
        'city',
        'country',
        'state',
        'zip',
        'image',
        'location',
        'long',
        'lat',
        'about',
        'about1',
        'about2',
        'opening_hours',

    ];

    public function users()
    {   
        return $this->hasMany(User::class);
    }
    // public function hospitalAdmin()
    // {
    //     return $this->hasOne(User::class,'hospital_id')->where('user_type','H');
    // }
    
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function scheduleSetting()
    {
        return $this->hasOne(ScheduleSetting::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function hospitalReviews()
    {
        return $this->hasMany(HospitalReview::class);
    }

    public function insurances()
    {
        return $this->belongsToMany(Insurance::class);
    }

    public function getImageAttribute($value){
        if($value !=null) return env('BASE_URL').'images/'.$value ;
    }
}
