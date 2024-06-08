<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;
    protected $table = 'app_setting';
    protected $fillable = ['notifications', 'msg_option','call_option', 'video_call_option', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
