<?php

namespace Database\Seeders;

use App\Models\BookAuthor;
use Illuminate\Database\Seeder;

class BookAuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $book_authors = [
            [
                'id' => 1,
                'name' => 'Teninet Setegn Wondrad',
                'status' => 1,
                'is_approved' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Kiros Mesele',
                'status' => 1,
                'is_approved' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Author 3',
                'status' => 1,
                'is_approved' => 1,
            ],
        ];

        BookAuthor::insert($book_authors);
    }
}
