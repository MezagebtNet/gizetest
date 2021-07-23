<?php

namespace Database\Seeders\FactorySettings;

use App\Models\BookFormat;
use Illuminate\Database\Seeder;

class BookFormatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book_formats = [
            [
                'id' => 1,
                'name' => 'Print Book (Paperback)',
            ],
            [
                'id' => 2,
                'name' => 'Print Book (Hardcover)',
            ],
            [
                'id' => 3,
                'name' => 'eBook',
            ],
            // [
            //     'id' => 4,
            //     'name' => 'eBook (PDF)',
            // ],
            // [
            //     'id' => 5,
            //     'name' => 'Board Book',
            // ],
        ];

        BookFormat::insert($book_formats);

        // $now = Carbon::now();

        // $yesterday = Carbon::yesterday();

        // $tomorrow = Carbon::tomorrow();

        // foreach (BookFormat::all() as $book_format) {
        //     $currencies = Currency::inRandomOrder()->take(rand(1, 2))->pluck('id');
        //     $book_format->currencies()->attach($currencies);
        //     // $book_format->published_at()->attach(inRandomOrder()->take(rand($now, $yesterday, $tomorrow)));
        // }
    }
}
