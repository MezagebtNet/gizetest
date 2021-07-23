<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->belongsToMany(Service::class, 'refund_service')
            ->withTimestamps();
    }

    public function claims()
    {
        return $this->belongsTo(Claims::class, 'claims_id');
    }
}
