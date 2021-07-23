<?php

namespace Database\Seeders\FactorySettings;

use App\Models\BookRoyaltyRate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookRoyaltyRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = Carbon::now();

        $yesterday = Carbon::yesterday();
        $old = '2020-11-26 00:00:00';

        $tomorrow = Carbon::tomorrow();

        $book_royalty_rates = [
            [
                'id' => 1,
                // 'min_price_range' => null,
                // 'max_price_range' => null,
                'book_format_id' => '1',
                'currency_id' => '1',
                'rate' => '40.0',
                'published_at' => $old,
            ],
            [
                'id' => 2,
                // 'min_price_range' => null,
                // 'max_price_range' => null,
                'book_format_id' => '1',
                'currency_id' => '2',
                'rate' => '45.0',
                'published_at' => $now,
            ],
            [
                'id' => 3,
                // 'min_price_range' => null,
                // 'max_price_range' => null,
                'book_format_id' => '2',
                'currency_id' => '1',
                'rate' => '40.0',
                'published_at' => $old,
            ],
            [
                'id' => 4,
                // 'min_price_range' => null,
                // 'max_price_range' => null,
                'book_format_id' => '1',
                'currency_id' => '1',
                'rate' => '55.0',
                'published_at' => $tomorrow,
            ],
            [
                'id' => 5,
                // 'min_price_range' => null,
                // 'max_price_range' => null,
                'book_format_id' => '1',
                'currency_id' => '2',
                'rate' => '56.0',
                'published_at' => $tomorrow,
            ],

            [
                'id' => 6,
                // 'min_price_range' => null,
                // 'max_price_range' => null,
                'book_format_id' => '1',
                'currency_id' => '2',
                'rate' => '57.0',
                'published_at' => $tomorrow,
            ],
        ];

        BookRoyaltyRate::insert($book_royalty_rates);
    }
}
