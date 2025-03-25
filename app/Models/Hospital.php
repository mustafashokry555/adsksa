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
        'city_id',
        'area_id',
        'zip',
        'image',
        'location',
        'long',
        'lat',
        'about',
        'about1',
        'about2',
        'opening_hours',
        'profile_images',
        'hospital_type_id',
        'mail',        // New field
        'phone',        // New field
        'whatsapp',     // New field
        'facebook',     // New field
        'instagram',    // New field
        'tiktok',       // New field
    ];
    protected $casts = [
        'profile_images' => 'array', // Ensures profile_images is handled as an array
    ];
    protected $appends = ['hospital_name', 'images_links'];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function banners()
    {
        return $this->hasMany(Banner::class);
    }
    public function hospitalType()
    {
        return $this->belongsTo(HospitalType::class);
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
    public function hospitalAdmin()
    {
        return $this->hasOne(User::class,'hospital_id')
        ->where('user_type','H');
    }

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
        if($value !=null) return env('BASE_URL').'images/'.rawurlencode($value) ;
    }

    public function getImagesLinksAttribute($value)
    {
        if ($this->profile_images != null) {
            $images = $this->profile_images;
            if (is_array($images)) {
                return array_map(function ($image) {
                    return env('BASE_URL') . 'images/' . rawurlencode($image);
                }, $images);
            }
        }
        return [];
    }

    public function getAvgRatingAttribute()
    {
        return $this->hospitalReviews()->avg('star_rated') ?? 0;
    }

    public function country()
    {
        return $this->hasOneThrough(Country::class, City::class, 'id', 'id', 'city_id', 'country_id');
    }
    public function state()
    {
        return $this->belongsTo(City::class);
    }
    public function city()
    {
        return $this->belongsTo(Area::class);
    }


    public function offers()
    {
        return $this->hasMany(Offer::class);
    }


    public function getHospitalNameAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->hospital_name_ar != NULL) {
            return $this->hospital_name_ar;
        }
        return $this->hospital_name_en;
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
