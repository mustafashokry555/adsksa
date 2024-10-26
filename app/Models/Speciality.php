<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $fillable = ['name_en', 'name_ar', 'image'];
    protected $appends = ['name'];

    public function users()
    {
        return $this->hasMany(User::class,'speciality_id');
    }

    public function getImageAttribute($value){
        if($value !=null) return env('BASE_URL').'images/'.$value; 
    }

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->name_ar != NULL) {
            return $this->name_ar;
        }
        return $this->name_en;
    }

}
