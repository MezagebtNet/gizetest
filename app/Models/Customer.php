<?php

namespace App\Models;

use App\Models\Claim;
use App\Models\Refund;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function refunds()
    {
        return $this->hasManyThrough(Refund::class, Claim::class);
    }

    public function latestClaim()
    {
        return $this->hasOne(Claim::class)->latestOfMany();
    }

}
