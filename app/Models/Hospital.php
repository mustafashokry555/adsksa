<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    public function doctors()
    {
        return $this->hasMany(User::class)
            ->where('user_type', User::DOCTOR); // Assuming 'D' is for doctors
    }
    public function patients()
    {
        return $this->hasMany(User::class)
            ->where('user_type', User::PATIENT); // Assuming 'D' is for doctors
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

    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }

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
    
    public function getAvgRatingAttribute()
    {
        return $this->hospitalReviews()->avg('star_rated') ?? 0;
    }

    public function getRatingCountAttribute()
    {
        return $this->hospitalReviews()->count();
    }

    public function specialities()
    {
        return $this->hasManyThrough(
            Speciality::class,
            User::class,
            'hospital_id',
            'id',
            'id',
            'speciality_id'
        )->where('user_type', User::DOCTOR)->distinct();
    }
}
