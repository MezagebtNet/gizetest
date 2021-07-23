<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class BookAuthor extends Model
{
    use HasFactory;
    use Searchable;

    /**
     * Get all of the books for the BookAuthor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function books(): HasManyThrough
    {
        return $this->hasManyThrough(Book::class, Bookable::class);
    }

    /**
     * Get all of the bookables for the BookAuthor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function bookables(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }
}
