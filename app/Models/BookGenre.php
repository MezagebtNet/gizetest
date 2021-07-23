<?php

namespace App\Models;

use App\Models\Bookable;
use App\Models\BookType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookGenre extends Model
{
    use HasFactory;

    /**
     * Get all of the bookables for the BookGenre
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookables()
    {
        return $this->hasMany(Bookable::class); //, 'foreign_key', 'local_key');
    }

    /**
     * Get the book_type that owns the BookGenre
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book_type(): BelongsTo
    {
        return $this->belongsTo(BookType::class);
    }
}
