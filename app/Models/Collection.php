<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Collection extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'title',
        'within_days',
        'for_hours',
        'duration',
        'unit_value',
        'seriesable',
        'series_no',
        'description',
        'poster_image_url',
        'thumb_image_url',
        'active',
        'is_featured',
        'gize_channel_id',
        'slug'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        // 'status',
        'collection_type',
        'channelvideo',

    ];

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


    public function parentCollection()
    {
        return $this->belongsTo(Collection::class, 'parent_id');

    }

    public function childCollections()
    {
        return $this->hasMany(Collection::class, 'parent_id');

    }

    public function getCollectionTypeAttribute($value){
        try {
            if($this->collection_type_id){
                return CollectionType::find($this->collection_type_id)->where('id', $this->collection_type_id)->first();
            }
        } catch (\Throwable $th) {
            // throw $th;
        }

        return collect([]);
    }

    public function getChannelvideoAttribute($value){
        try {
            if($this->id){
                return Collection::find($this->id)->channelvideos()->where('active',1)->get();
            }
        } catch (\Throwable $th) {
            // throw $th;
        }

        return collect([]);
    }



    /**
     * The channelvideos that belong to the Channelvideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function channelvideos()
    {
        return $this->belongsToMany(Channelvideo::class)
        ->withPivot('id')
        ->withTimestamps();
    }

    /**
     * Get the collection_types that owns the Collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collection_types()
    {
        return $this->belongsTo(CollectionType::class);
    }

}
