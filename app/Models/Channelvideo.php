<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Channelvideo extends Model
{
    use HasFactory;
    use SoftDeletes;

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
        'video_available_for',
        'is_free',
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

    /**
     * The batches that belong to the Channelvideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_channelvideo', 'channelvideo_id', 'batch_id')
            ->withPivot(['starts_at', 'ends_at'])
            // ->as('batch_channelvideo')
            ->withTimestamps();
    }

    /**
     * The users that belong to the Channelvideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users($status = null)
    {
        if($status != null){ //started_watching, completed..
            //0 - filter rentals user not watched
            //1 - filter rentals user started watching
            //2 - filter rentals user completed watching
            return $this->belongsToMany(User::class, 'channelvideo_rentals', 'channelvideo_id', 'user_id')
            ->withPivot('id', 'status', 'within_days', 'for_hours', 'started_at', 'published_at')
            ->wherePivot('status', $status)
            ->as ('rental_detail')
            ->withTimestamps();
        }

        return $this->belongsToMany(User::class, 'channelvideo_rentals', 'channelvideo_id', 'user_id')
        ->withPivot('id', 'status', 'within_days', 'for_hours', 'started_at')
        ->as ('rental_detail')
        ->withTimestamps();
    }

}
