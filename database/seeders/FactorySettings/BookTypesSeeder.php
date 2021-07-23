<?php

namespace Database\Seeders\FactorySettings;

use App\Models\BookType;
use Illuminate\Database\Seeder;

class BookTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book_types = [
            [
                'id' => 1,
                'name' => 'Fiction',
            ],
            [
                'id' => 2,
                'name' => 'Non-Fiction',
            ],
            [
                'id' => 3,
                'name' => 'Wisdom',
            ],
        ];

        BookType::insert($book_types);
    }
}
