<?php

namespace App\Models;

use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookGenre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    use HasFactory;

    /**
     * Get all of the books for the Bookable
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class); //, 'foreign_key', 'local_key');
    }

    /**
     * Get the book_author that owns the Bookable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book_author()
    {
        return $this->belongsTo(BookAuthor::class); //, 'foreign_key', 'other_key');
    }

    /**
     * Get the book_genre that owns the Bookable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book_genre()
    {
        return $this->belongsTo(BookGenre::class); //, 'foreign_key', 'other_key');
    }

}
