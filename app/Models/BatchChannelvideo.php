<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Jenssegers\Date\Date;

class BatchChannelvideo extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public $table = "batch_channelvideo";

    // protected $table = 'batch_user_subscription_period';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'starts_at',
        'ends_at',
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
        $video_id = $this->channelvideo_id;

        $video_detail = Channelvideo::where('id', $video_id)->where('active', 1)->get();



        return $video_detail;

    }

    /**
     * The batch_users that belong to the BatchChannelvideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function batch_users()
    {
        return $this->belongsToMany(BatchUser::class, 'batch_video_activity', 'batch_channelvideo_id', 'user_id')
            ->withPivot([
                'status',
                'started_at',
                'ip_address',
                'user_agent',
                'view_count'
            ])
            ->withTimestamps();
    }


}
