<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Eloquent\Model;

class BatchVideoActivity extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public $table = "batch_video_activity";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'started_at',
        'user_agent',
        'ip_address',
        'view_count',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'video',
    ];


    public function getVideoAttribute($value)
    {
        $batch_channelvideo_id = $this->batch_channelvideo_id;

        $batch_channelvideo = BatchChannelvideo::where('id', $batch_channelvideo_id)->first();

        $video_detail = $batch_channelvideo->video;

        return $video_detail;

    }



}
