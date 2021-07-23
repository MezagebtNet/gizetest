<?php

namespace App\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function State()
    {
        return $this->belongsToMany(State::class, 'state_id');
    }
}
