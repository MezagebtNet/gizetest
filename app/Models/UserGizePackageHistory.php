<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGizePackageHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_gize_package_id',
        'unit_value_used',
        'for_model',
    ];

    protected $table = "user_gize_package_history";

    /**
     * Get the user_gize_package that owns the UserGizePackageHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_gize_package()
    {
        return $this->belongsTo(UserGizePackage::class);
    }


}
