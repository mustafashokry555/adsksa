<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['website_name', 'logo', 'favicon', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'country', 'facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'email', 'phone'];
}
