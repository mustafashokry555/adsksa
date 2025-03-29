<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name_en', 'name_ar', 'state_id'];
    protected $appends = ['name'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function country()
    {
        return $this->hasOneThrough(Country::class, State::class, 'id', 'id', 'state_id', 'country_id');
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
