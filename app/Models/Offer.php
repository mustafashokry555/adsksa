<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'type',
        'video_link',
        'hospital_id',
        'is_active',
        'images'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function geTtitleAttribute($value)
    {
        if (app()->getLocale() == 'ar') {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }

    public function getContentAttribute($value)
    {
        if (app()->getLocale() == 'ar') {
            return $this->content_ar;
        } else {
            return $this->content_en;
        }
    }

    public function getImagesAttribute($value)
    {
        if ($value) {
            $images = [];
            foreach( json_decode($value) as $image){
                $image = asset('images/'.$image);
                $images[] = $image;
            }
            return $images;
        }
        return $value;
    }
}
