<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'user_id', 'blog_title', 'blog_body', 'blog_image'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
