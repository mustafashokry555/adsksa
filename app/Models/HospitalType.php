<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalType extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en'];

    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }
    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->name_ar != NULL) {
            return $this->name_ar;
        }
        return $this->name_en;
    }
}
