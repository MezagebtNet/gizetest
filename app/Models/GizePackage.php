<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GizePackage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'months',
        'for_unit_values',
        'etb_amount',
        'usd_amount',
        'feature_description',
        'active',
    ];

    /**
     * The users that belong to the GizePackage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_gize_package', 'gize_package_id', 'user_id')
        ->withPivot([
            'user_id',
            'gize_package_id',
            'unit_values_balance',
            'start_date',
            'payment_method',
        ])
        ->withTimestamps();
    }


}
