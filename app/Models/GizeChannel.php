<?php

namespace App\Models;

use App\Models\Channelvideo;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GizeChannel extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'producer',
        'description',
    ];

    protected $appends = [
        'channel_admins'
    ];

    public function getChannelAdminsAttribute($value){
        //
    }


    /**
     * The users that belong to the GizeChannel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'gize_channel_user', 'gize_channel_id', 'user_id');
    }



    public function categories()
    {
        return $this->belongsToMany(ChannelCategory::class);

    }

    /**
     * Get all of the videochannels for the GizeChannel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function channelvideos()
    {
        return $this->hasMany(Channelvideo::class, 'channelvideo_id', 'id');
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

    /**
     * Get all of the batches for the GizeChannel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function isPermittedEditor(User $user){
        // return true;
        if($user->hasRole('super-admin')){
            return true;
        }
        elseif($this->users()->get()->contains($user) && $user->hasRole('channel-admin')){
            return true;
        }
        return false; //or abort(403);
    }

}
