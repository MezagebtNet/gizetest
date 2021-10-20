<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class BatchUser extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'approved',
        'active',
    ];

    protected $appends = [
        'subscriber_name',
        'subscriber',
        'payment_history',
        'total_paid',
        'currency',
        'max_period_no',
        'subscription_type',
    ];

    public function getTotalPaidForBatch($batch_id)
    {

        $k = SubscriptionPeriod::where('batch_id', $batch_id)->get()->pluck('id');
        $total_paid = DB::table('subscription_payments')
            ->where('batch_user_id', $this->id)
            ->whereIn('subscription_period_id',
                $k)
            ->sum('amount');
        return $total_paid;
    }

    public function getSubscriptionTypeAttribute($value)
    {
        $batch = Batch::find($this->batch_id);
        return $batch->subscription_type_name;
    }

    public function getMaxPeriodNoAttribute($value)
    {
        $batch = Batch::find($this->batch_id);
        return $batch->max_period_no;
    }

    public function getCurrencyAttribute($value)
    {
        $batch = Batch::find($this->batch_id);
        return $batch->currency;
    }

    public function getTotalPaidAttribute($value)
    {

        $subscription_payments = DB::table('subscription_payments')
            ->where('batch_user_id', $this->id)
			->where('batch_id', $this->batch_id)
            ->join('subscription_periods', 'subscription_payments.subscription_period_id', '=', 'subscription_periods.id')
            ->get();

        return $subscription_payments->sum('amount');
    }

    public function getPaymentHistoryAttribute($value)
    {
        return $this->subscriptionPayments();
    }

    public function getSubscriberNameAttribute($value)
    {
        $user_id = $this->user_id;

        $user_fullname = User::find($user_id)->fullName();

        return $user_fullname;
    }

    public function getSubscriberAttribute($value)
    {
        $user_id = $this->user_id;

        return User::where('id', $user_id)->first();
    }

    public function subscriptionPayments()
    {
        $subscription_payments = DB::table('subscription_payments')
            ->where('batch_user_id', $this->id)
            ->where('batch_id', $this->batch_id)
            ->join('subscription_periods', 'subscription_payments.subscription_period_id', '=', 'subscription_periods.id')
            ->get();

        // return (object) [

        return $subscription_payments;

        // ];

    }

    /**
     * The subscriptionPeriods that belong to the BatchUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscriptionPeriods()
    {
        return $this->belongsToMany(SubscriptionPeriod::class, 'subscription_payments', 'batch_user_id', 'subscription_period_id');
    }


    /**
     * The batch_channelvideos that belong to the BatchChannelvideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function batch_channelvideos()
    {
        return $this->belongsToMany(BatchChannelvideo::class, 'batch_video_activity', 'batch_user_id', 'batch_channelvideo_id')
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
