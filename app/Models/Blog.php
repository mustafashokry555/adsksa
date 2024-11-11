<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'user_id', 'blog_title_en', 'blog_title_ar', 'blog_body_en', 'blog_body_ar', 'blog_image'];
    protected $appends = ['blog_title', 'blog_body'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function getBlogTitleAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->blog_title_ar != NULL) {
            return $this->blog_title_ar;
        }
        return $this->blog_title_en;
    }
    public function getBlogBodyAttribute()
    {
        if (app()->getLocale() == 'ar' && $this->blog_body_ar != NULL) {
            return $this->blog_body_ar;
        }
        return $this->blog_body_en;
    }
}
