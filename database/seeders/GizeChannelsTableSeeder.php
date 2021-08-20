<?php

namespace Database\Seeders;

use App\Models\ChannelCategory;
use App\Models\GizeChannel;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class GizeChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $gize_channels = [
        //     "id" => 1,
        //     "name" => "Addmes",
        //     "description" => "Channel Description",
        //     'created_at' => Date::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Date::now()->format('Y-m-d H:i:s'),
        // ];

        // GizeChannel::insert($gize_channels);

        $faker = Faker::create();
        $categories = ChannelCategory::whereHas('parentCategory.parentCategory')->pluck('id');

        for ($i = 1; $i <= 4; $i++) {
            $gize_channel = GizeChannel::create([
                'name' => $faker->sentence(3),
                'slug' => $faker->unique()->slug(2),
                'description' => $faker->paragraph,
                'created_at' => Date::now()->format('Y-m-d H:i:s'),
                'updated_at' => Date::now()->format('Y-m-d H:i:s'),
            ]);

            if (count($categories)) {
                $gize_channel->categories()->sync($categories->random(mt_rand(1, 3)));
            }

        }
    }
}
