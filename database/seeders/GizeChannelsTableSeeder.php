<?php

namespace Database\Seeders;

use App\Models\ChannelCategory;
use App\Models\GizeChannel;
use Faker\Factory as Faker;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\Company;
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

        for ($i = 1; $i <= 2; $i++) {
            $gize_channel = GizeChannel::create([
                'name' => $faker->sentence(2),
                // 'owner' => $faker->name($gender = null|'male'|'female'), // ባለቤት
                'producer' => $faker->randomElement([$faker->company(), 'አድሜሽ የመጽሐፍት ንግድ ሥራ']), // አዘጋጅ
                'slug' => $faker->unique()->slug(2),
                'description' =>  $faker->sentence(3),
                'created_at' => Date::now()->format('Y-m-d H:i:s'),
                'updated_at' => Date::now()->format('Y-m-d H:i:s'),
            ]);

            if (count($categories)) {
                $gize_channel->categories()->sync($categories->random(mt_rand(1, 3)));
            }

        }
    }
}
