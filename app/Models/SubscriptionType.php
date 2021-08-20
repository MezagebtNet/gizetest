<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get all of the subscription_periods for the SubscriptionType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscription_periods(): HasMany
    {
        return $this->hasMany(SubscriptionPeriod::class);
    }

    /**
     * Get all of the batches for the SubscriptionType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }
}
