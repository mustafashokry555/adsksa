<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['hospital_id', 'image', 'subject_en', 'subject_ar', 'is_active', 'expired_at'];
    protected $appends = ['subject'];

    public function hospital()
    {
        return $this->belongsToMany(Hospital::class);
    }

    public function getImageAttribute($value){
        if($value !=null) return env('BASE_URL').'images/banners/'.$value ;
    }

    public function getSubjectAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->subject_ar != NULL) {
            return $this->subject_ar;
        }
        return $this->subject_en;
    }
}
