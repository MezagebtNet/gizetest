<?php

namespace Database\Seeders\FactorySettings;

use App\Models\BookGenre;
use Illuminate\Database\Seeder;

class BookGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book_genres = [
            [
                'id' => 1,
                'book_type_id' => 1,
                'name' => 'Science Fiction',
            ],
            [
                'id' => 2,
                'book_type_id' => 1,
                'name' => 'Historical',
            ],
            [
                'id' => 3,
                'book_type_id' => 2,
                'name' => 'History',
            ],
            [
                'id' => 4,
                'book_type_id' => 2,
                'name' => 'How-To / Guide Book',
            ],
        ];

        BookGenre::insert($book_genres);
    }
}
