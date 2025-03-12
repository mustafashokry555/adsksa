<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
    ];

    /**
     * Get the users that belong to this religion.
     */
    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->name_ar != NULL) {
            return $this->name_ar;
        }
        return $this->name_en;
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
