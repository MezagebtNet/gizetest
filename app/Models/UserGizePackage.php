<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserGizePackage extends Pivot
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'gize_package_id',
        'unit_values_balance',
        'usd_amount',
        'start_date',
        'payment_method',
    ];

    public $incrementing = true;

    public $table = "user_gize_package";

    protected $appends = [
        'gize_package',
        'user',
    ];

    public function getGizePackageAttribute($value){
        $gize_package = GizePackage::find($this->gize_package_id);
        return $gize_package;
    }

    public function getUserAttribute($value){
        $user = User::find($this->user_id);
        return $user;
    }


    /**
     * Get all of the user_gize_package_history for the UserGizePackage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_gize_package_history()
    {
        return $this->hasMany(UserGizePackageHistory::class, 'user_gize_package_id', 'id');
    }

}
