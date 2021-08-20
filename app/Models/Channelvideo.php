<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channelvideo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'trainer',
        'duration',
        'price',
        'description',
        'category_id',
        'file_url',
        'hls_uploaded',
        'keys_uploaded',
        'storage_disk',
        'file_type',
        'sample_file_url',
        'sample_file_type',
        'poster_image_url',
        'thumb_image_url',
    ];

    public function channelvideoCategories()
    {
        return $this->belongsToMany(ChannelvideoCategory::class);
    }

    /**
     * Get the gizeChannel that owns the Channelvideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gizeChannel()
    {
        return $this->belongsTo(GizeChannel::class);
    }

}
