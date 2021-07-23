<?php

namespace Database\Seeders\BookData;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'id' => 1,
                'bookable_id' => 1,
                'book_language_id' => 1,
                'book_format_id' => 1,
                'edition_no' => 1,
                'publisher' => 'Addmesh Book Trading',
                'publish_year' => '2021',
                'publish_month' => 'May',
                'publish_date' => null,
                'pages' => 150,
                'translated_by' => null,
                'ISBN_10' => null,
                'ISBN_13' => '9789994430451',
            ],
            [
                'id' => 2,
                'bookable_id' => 2,
                'book_language_id' => 1,
                'book_format_id' => 1,
                'edition_no' => 1,
                'publisher' => 'Addmesh Book Trading',
                'publish_year' => '2020',
                'publish_month' => 'June',
                'publish_date' => null,
                'pages' => 150,
                'translated_by' => null,
                'ISBN_10' => null,
                'ISBN_13' => '9789994487356',
            ],
            [
                'id' => 3,
                'bookable_id' => 3,
                'book_language_id' => 1,
                'book_format_id' => 1,
                'edition_no' => 1,
                'publisher' => 'Addmesh Book Trading',
                'publish_year' => '2020',
                'publish_month' => 'June',
                'publish_date' => null,
                'pages' => 150,
                'translated_by' => null,
                'ISBN_10' => null,
                'ISBN_13' => '9789994487356',
            ],
            [
                'id' => 4,
                'bookable_id' => 2,
                'book_language_id' => 1,
                'book_format_id' => 3,
                'edition_no' => 1,
                'publisher' => 'Addmesh Book Trading',
                'publish_year' => '2020',
                'publish_month' => 'June',
                'publish_date' => null,
                'pages' => 150,
                'translated_by' => null,
                'ISBN_10' => null,
                'ISBN_13' => null,
            ],
        ];

        Book::insert($books);
    }
}
