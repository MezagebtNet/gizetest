<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelvideoAccessByAppUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'channelvideo_id',
        'revoked',
    ];

    // protected $casts = [
    //     'app_user_id' => 'int',
    //     'lecture_video_id' => 'int',
    //     'revoked' => 'int',
    // ];

}
