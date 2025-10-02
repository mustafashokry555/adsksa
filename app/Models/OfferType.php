<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferType extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'image', 'status'];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->name_ar != NULL) {
            return $this->name_ar;
        }
        return $this->name_en;
    }
}
