<?php

namespace App\Models;

use App\Models\BookRoyaltyRate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookFormat extends Model
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

    /**
     * The currencies that belong to the BookFormat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function currencies()
    {

        $latest_rates = DB::select('SELECT `id`, `a`.`book_format_id` FROM ( select `book_format_id`, max(`currency_id`) , `book_royalty_rate`.`id` as `id`  from `book_royalty_rate` group by `book_royalty_rate`.`book_format_id`, `book_royalty_rate`.`currency_id` ) `a` ');

        // dd($latest_rates);
        // $latest_rates_array = $latest_rates->toArray();
        $now = Carbon::now();

        return $this->belongsToMany(Currency::class, 'book_royalty_rate', 'book_format_id', 'currency_id')
            ->withPivot(
                'id',
                // 'min_price_range',
                // 'max_price_range',
                'currency_id',
                'book_format_id',
                'rate',
                'published_at',
            )
            ->using(BookRoyaltyRate::class)
            ->withTimestamps()
            ->orderByDesc('published_at')
            ->groupBy('currency_id', 'book_format_id')
        // ->orderByDesc('id')
            ->wherePivotIn('id', array_column($latest_rates, 'id'));

        // ->wherePivotBetween('published_at', ['1900-01-01 00:00:00', $now]);

        // dd($collection);
        // foreach ($collection as $col) {
        // }

        // ->wherePivotIn('id', array_column($latest_rates, 'id'));

        // return $this->hasOne(BookRoyaltyRate::class)->ofMany([
        //     'published_at' => 'max',
        //     'id' => 'max',
        // ], function ($query) use ($currency_id) {
        //     $query->where('published_at', '<', now())->where('currency_id', '=', $currency_id);
        // });
    }

    /**
     * Get all of the books for the BookFormat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class); //, 'foreign_key', 'local_key');
    }

    /**
     * Get all of the book_royalty_rates for the BookFormat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book_royalty_rates()
    {
        return $this->hasMany(BookRoyaltyRate::class); //, 'foreign_key', 'local_key');
    }

    /**
     * Get the book format's latest book royalty rate.
     */
    public function latest_book_royalty_rate()
    {
        return $this->hasOne(BookRoyaltyRate::class)->ofMany('published_at', 'max');
    }

    /**
     * Get the current rating of the book format for a given currency id.
     */
    public function currentRating($currency_id)
    {
        return $this->hasOne(BookRoyaltyRate::class)->ofMany([
            'published_at' => 'max',
            'id' => 'max',
        ], function ($query) use ($currency_id) {
            $query->where('published_at', '<', now())->where('currency_id', '=', $currency_id);
        });
    }

    /**
     * Get the all ratings for the book format.
     */
    public function allRatings()
    {
        return $this->hasOne(BookRoyaltyRate::class)->ofMany([
            'published_at' => 'max',
            'id' => 'max',
        ], function ($query) {
            $query->where('published_at', '<', now());
        });
    }

}
