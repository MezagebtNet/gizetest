<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class ChannelvideoActivity extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public $table = "channelvideo_activity";

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
        $channelvideo_id = $this->channelvideo_id;

        $channelvideo = Channelvideo::where('id', $channelvideo_id)->first();

        return $channelvideo;

    }

}
