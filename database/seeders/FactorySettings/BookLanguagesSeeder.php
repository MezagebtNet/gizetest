<?php

namespace Database\Seeders\FactorySettings;

use App\Models\BookLanguage;
use Illuminate\Database\Seeder;

class BookLanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book_languages = [
            [
                'id' => 1,
                'language_name' => 'Amharic',
                'language_native_name' => 'አማርኛ',
                'language_code' => 'am',
            ],
            [
                'id' => 2,
                'language_name' => 'English',
                'language_native_name' => 'English',
                'language_code' => 'en',
            ],
        ];

        BookLanguage::insert($book_languages);
    }
}
