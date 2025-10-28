<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['website_name', 'tax_number', 'vat',
    'privacy_policy_en', 'privacy_policy_ar', 'terms_ar', 'terms_en', 'return_policy_ar', 'return_policy_en',
    'logo', 'favicon', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'country', 'facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'email', 'phone'];

    public function getPrivacyPolicyAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->privacy_policy_ar != NULL) {
            return $this->privacy_policy_ar;
        }
        return $this->privacy_policy_en;
    }

    public function getReturnPolicyAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->return_policy_ar != NULL) {
            return $this->return_policy_ar;
        }
        return $this->return_policy_en;
    }

    public function getTermsAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->terms_ar != NULL) {
            return $this->terms_ar;
        }
        return $this->terms_en;
    }

    public function getAddressAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->address_line_1 != NULL) {
            return $this->address_line_2;
        }
        return $this->address_line_1;
    }
}
