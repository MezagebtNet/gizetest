<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function Cities()
    {
        return $this->hasMany(City::class, 'states_id');
    }
}
