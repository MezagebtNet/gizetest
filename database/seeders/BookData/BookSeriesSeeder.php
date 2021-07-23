<?php

namespace Database\Seeders\BookData;

use App\Models\BookSeries;
use Illuminate\Database\Seeder;

class BookSeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book_series = [
            [
                'id' => 1,
                'title' => 'Book of Alchemy Series',
            ],
        ];

        BookSeries::insert($book_series);
    }
}
