<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelCategory extends Model
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
        'channel_category_id',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(ChannelCategory::class, 'channel_category_id');

    }

    public function childCategories()
    {
        return $this->hasMany(ChannelCategory::class, 'channel_category_id');

    }

    public function channels()
    {
        return $this->belongsToMany(GizeChannel::class);

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
