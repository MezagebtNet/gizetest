<?php

namespace Database\Seeders;

use App\Models\ChannelvideoCategory;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ChannelvideoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            $category = ChannelvideoCategory::create([
                'name' => ucfirst($faker->word),
                'slug' => $faker->unique()->slug(3 . mt_rand(99, 150)),
                'description' => $faker->paragraph,
            ]);

            for ($j = 1; $j <= 5; $j++) {
                $childCategory = $category->childCategories()->create([
                    'name' => $faker->sentence(2),
                    'slug' => $faker->unique()->slug(3 . mt_rand(99, 150)),
                    'description' => $faker->paragraph,
                ]);

                for ($k = 1; $k <= 5; $k++) {
                    $childCategory->childCategories()->create([
                        'name' => $faker->sentence(3),
                        'slug' => $faker->unique()->slug(3 . mt_rand(99, 150)),
                        'description' => $faker->paragraph,
                    ]);
                }
            }
        }
    }
}
