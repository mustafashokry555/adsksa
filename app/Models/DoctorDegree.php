<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorDegree extends Model
{
    use SoftDeletes;

    protected $table = 'doctor_degrees';

    protected $fillable = [
        'name_en',
        'name_ar',
        'code_en',
        'code_ar',
    ];

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->name_ar != NULL) {
            return $this->name_ar;
        }
        return $this->name_en;
    }

    public function getCodeAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->code_ar != NULL) {
            return $this->code_ar;
        }
        return $this->code_en;
    }
}
