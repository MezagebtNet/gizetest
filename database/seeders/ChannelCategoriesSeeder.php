<?php
namespace Database\Seeders;

use App\Models\ChannelCategory;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ChannelCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $channel_categories = [
        //     "id" => 1,
        //     "name" => "Explanation Videos",
        //     "slug" => "explanation-videos",
        //     "channel_category_id" => null,
        // ];

        // ChannelCategory::insert($channel_categories);

        $faker = Faker::create();
        // $categories = ChannelCategory::whereHas('parentCategory.parentCategory')->pluck('id');

        for ($i = 1; $i <= 5; $i++) {
            $category = ChannelCategory::create([
                'name' => ucfirst($faker->word),
                'slug' => $faker->unique()->slug(3 . mt_rand(1, 20)),
                'description' => $faker->paragraph,
            ]);

            for ($j = 1; $j <= 5; $j++) {
                $childCategory = $category->childCategories()->create([
                    'name' => $faker->sentence(2),
                    'slug' => $faker->unique()->slug(3 . mt_rand(1, 20)),
                    'description' => $faker->paragraph,
                ]);

                for ($k = 1; $k <= 5; $k++) {
                    $childCategory->childCategories()->create([
                        'name' => $faker->sentence(3),
                        'slug' => $faker->unique()->slug(3 . mt_rand(1, 20)),
                        'description' => $faker->paragraph,
                    ]);
                }
            }
        }
    }
}
