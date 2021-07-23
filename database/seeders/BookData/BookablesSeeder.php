<?php

namespace Database\Seeders\BookData;

use App\Models\Bookable;
use Illuminate\Database\Seeder;

class BookablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookables = [
            [
                'id' => 1,
                'title' => 'Alpha Kirub',
                'book_author_id' => 2,
                'book_genre_id' => 4,
                'status' => 1,
                'featured' => 1,
                'seriesable' => 0,
                'series_no' => null,
                'book_series_id' => null,
            ],
            [
                'id' => 2,
                'title' => 'Book of Addmess - Alchemy 1',
                'book_author_id' => 1,
                'book_genre_id' => 3,
                'status' => 1,
                'featured' => 1,
                'seriesable' => 1,
                'series_no' => 1,
                'book_series_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Book of Addmess - Alchemy 2',
                'book_author_id' => 1,
                'book_genre_id' => 1,
                'status' => 1,
                'featured' => 1,
                'seriesable' => 1,
                'series_no' => 2,
                'book_series_id' => 1,
            ],
        ];

        Bookable::insert($bookables);
    }
}
