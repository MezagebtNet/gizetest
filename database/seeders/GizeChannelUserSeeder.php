<?php

namespace Database\Seeders;

use App\Models\GizeChannel;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GizeChannelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $gize_channels = GizeChannel::all();
        foreach ($gize_channels as $gize_channel) {
            $gize_channel->users()->attach(
                $faker->randomElements([2, 4, 5])
            );
        }
    }
}
