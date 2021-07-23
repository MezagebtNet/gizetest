<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * Get the bookable that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookable()
    {
        return $this->belongsTo(Bookable::class); //, 'foreign_key', 'other_key');
    }

    /**
     * Get the book_language that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book_language()
    {
        return $this->belongsTo(BookLanguage::class); //, 'foreign_key', 'other_key');
    }

    /**
     * Get the book_format that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book_format()
    {
        return $this->belongsTo(BookFormat::class); //, 'foreign_key', 'other_key');
    }

    /**
     * Get all of the book_prices for the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book_prices()
    {
        return $this->hasMany(BookPrice::class); //, 'foreign_key', 'local_key');

    }

    /**
     * Get all of the latest_price for the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function latest_price()
    {
        return $this->hasOne(BookPrice::class)->ofMany([
            'published_at' => 'max',
            'id' => 'max',
        ], function ($query) {
            $query->where('published_at', '<', now());
        });
    }

    /**
     * Get the current pricing for the product.
     */
    public function currentPricing()
    {
        return $this->hasOne(BookPrice::class)->ofMany([
            'published_at' => 'max',
            'id' => 'max',
        ], function ($query) {
            $query->where('published_at', '<', now());
        });
    }

    /**
     * The currencies that belong to the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'book_prices', 'book_id', 'currency_id')
        // ->using(BookPrice::class)
            ->withPivot('price', 'published_at')
            ->as('prices')
            ->withTimestamps();
    }
}
