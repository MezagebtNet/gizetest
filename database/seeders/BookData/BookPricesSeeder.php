<?php

namespace Database\Seeders\BookData;

use App\Models\BookPrice;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookPricesSeeder extends Seeder
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

        $tomorrow = Carbon::tomorrow();

        $book_prices = [
            [
                'id' => 1,
                'book_id' => 1,
                'currency_id' => 1,
                'price' => 200.0,
                'published_at' => $now,
            ],
            [
                'id' => 2,
                'book_id' => 2,
                'currency_id' => 1,
                'price' => 200.0,
                'published_at' => $now,
            ],
            [
                'id' => 3,
                'book_id' => 3,
                'currency_id' => 1,
                'price' => 150.0,
                'published_at' => $now,
            ],
            [
                'id' => 4,
                'book_id' => 1,
                'currency_id' => 2,
                'price' => 40.0,
                'published_at' => $now,
            ],
            [
                'id' => 5,
                'book_id' => 4,
                'currency_id' => 1,
                'price' => 25,
                'published_at' => $yesterday,
            ],
            [
                'id' => 6,
                'book_id' => 4,
                'currency_id' => 1,
                'price' => 10,
                'published_at' => $now,
            ],
            [
                'id' => 7,
                'book_id' => 4,
                'currency_id' => 1,
                'price' => 5,
                'published_at' => $tomorrow,
            ],
        ];

        BookPrice::insert($book_prices);
    }
}
