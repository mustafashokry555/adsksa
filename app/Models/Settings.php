<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['website_name', 
    'privacy_policy_en', 'privacy_policy_ar',
    'logo', 'favicon', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'country', 'facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'email', 'phone'];

    public function getPrivacyPolicyAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->privacy_policy_ar != NULL) {
            return $this->privacy_policy_ar;
        }
        return $this->privacy_policy_en;
    }
}
