<?php

namespace App\Models;

use App\Models\BookGenre;
use App\Models\BookType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function book_genres()
    {

        return $this->hasMany(BookGenre::class);
    }

    /**
     * Get the book_type that owns the BookType
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book_type()
    {
        return $this->belongsTo(BookType::class);
    }
}
