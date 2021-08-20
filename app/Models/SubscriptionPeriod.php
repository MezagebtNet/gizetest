<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPeriod extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'period_no',
        'from_date',
        'to_date',
    ];

    /**
     * The subscribers that belong to the BatchUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribers()
    {
        return $this->belongsToMany(SubscriptionPeriod::class, 'subscription_payments', 'subscription_period_id', 'batch_user_id')
            ->withPivot(['amount', 'reciept_no', 'payment_date', 'method'])
            ->as('subscription_payment')
            ->withTimestamps();
    }

    /**
     * Get the batch that owns the SubscriptionPeriod
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
