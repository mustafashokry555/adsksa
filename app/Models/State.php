<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name_en', 'name_ar', 'country_id'];
    protected $appends = ['name'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
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
