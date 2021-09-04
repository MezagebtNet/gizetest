<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code_name',
        'description',
        // 'subscription_period_id',
        'gize_channel_id',
        'starts_on_date',
        'payment_fee',
        'currency',
        'status',
        'subscription_type_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        // 'status',
        'status_name',
        // 'starts_on_date_formated',
        'subscription_type_name',
        'max_period_no',
        'max_period_name',
        'subscribers_count',
        'subscription_periods',
    ];

    public function getSubscriptionPeriodsAttribute($value)
    {
        if($this->id){
            return Batch::find($this->id)->subscriptionPeriods()->get();
        }
        return [];
    }

    public function getSubscribersCountAttribute($value)
    {
        return $this->subscribersCount();
    }

    public function getMaxPeriodNoAttribute($value)
    {
        return $this->maxPeriodNo();
    }


    public function getMaxPeriodNameAttribute($value)
    {
        return $this->maxPeriodName();
    }

    public function getStartsOnDateAttribute($value)
    {
        // $value = $this->starts_on_date;
        $fmtDate = Carbon::parse($value)->format('d-m-Y h:m a');
        return $fmtDate;
    }

    public function getStatusNameAttribute($value)
    {
        // if(isset($this->attributes['password']) && $this->attributes['password'] != ''){
        // return $this->status;
        $value = $this->status;
        //0-Not-started, 1-Ongoing, 2-Onhold, 3-Closed ...
        switch ($value) {
            case 0:
                $status = 'Not Started';
                break;
            case 1:
                $status = 'Ongoing';
                break;
            case 2:
                $status = 'Onhold';
                break;
            case 3:
                $status = 'Closed';
                break;

            default:
                $status = 'Not Started';
                break;
        }
        return $this->attributes['status'] = $status;
        // return Carbon::createFromFormat('Y-m-d H:i:s', $this->starts_on_date)->format('Y');
        // }
        // return $value;
    }

    public function getSubscriptionTypeNameAttribute($value)
    {
        $id = $this->subscription_type_id;
        $subscription_type = SubscriptionType::where('id', $id)->value('name');
        return $subscription_type;
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('approved', 'active')
            ->as('subscription')
            ->withTimestamps();

    }

    /**
     * Get the subscriptionType that owns the Batch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscriptionType()
    {
        return $this->belongsTo(SubscriptionType::class);
    }

    /**
     * Get all of the subscriptionPeriods for the Batch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptionPeriods()
    {
        return $this->hasMany(SubscriptionPeriod::class);
    }

    /**
     * Get the last period no for the batch.
     */
    public function maxPeriodNo()
    {
        $subscription_periods = $this->subscriptionPeriods()->get();
        return $subscription_periods->max('period_no');

        return (object) [
            'max_period_no' => $subscription_periods->max('period_no'),
            // 'from_date' => $subscription_periods->min('name'),
            // 'to_date' => $subscription_periods->max('name'),
            // 'price_min' => $dwellings->min('pivot_price_min'),
            // 'price_max' => $prices_max->max('pivot_price_max'),
        ];
        // return $subscription_period->subscription_period_id;
    }


    /**
     * Get the last Period name for the batch.
     */
    public function maxPeriodName()
    {
        $periods = SubscriptionPeriod::where('batch_id', $this->id);
        return Batch::find($this->id)->subscriptionPeriods()->where('period_no', max($periods->pluck('period_no')->toArray()))->value('name');


    }

    public function subscribersCount()
    {
        $batch_user = BatchUser::where('batch_id', $this->id);
        return (object) [
            'approved' => BatchUser::where('approved', 1)->where('batch_id', $this->id)->count(),
            'not_approved' => BatchUser::where('approved', 0)->where('batch_id', $this->id)->count(),
            'active' => BatchUser::where('active', 1)->where('batch_id', $this->id)->count(),
            'not_active' => BatchUser::where('active', 0)->where('batch_id', $this->id)->count(),
            // 'not_approve'
        ];

    }


    /**
     * The channelvideos that belong to the BatchUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function channelvideos()
    {
        return $this->belongsToMany(Channelvideo::class, 'batch_channelvideo', 'batch_id', 'channelvideo_id')
            ->withPivot(['starts_at', 'ends_at'])
            // ->as('batch_channelvideo')
            ->withTimestamps();
    }

    /**
     * Get the gize_channel that owns the Batch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gize_channel()
    {
        return $this->belongsTo(GizeChannel::class);
    }

}
