<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelvideoCategory extends Model
{
    use HasFactory;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'channelvideo_category_id',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(ChannelvideoCategory::class, 'channelvideo_category_id');

    }

    public function childCategories()
    {
        return $this->hasMany(ChannelvideoCategory::class, 'channelvideo_category_id');

    }

    public function channelvideos()
    {
        return $this->belongsToMany(Channelvideo::class);

    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
