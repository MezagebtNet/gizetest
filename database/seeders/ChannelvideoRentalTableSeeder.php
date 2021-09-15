<?php

namespace Database\Seeders;

use App\Models\Channelvideo;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class ChannelvideoRentalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $channelvideos = Channelvideo::all();

        $users = User::all()->pluck('id');

        $channelvideos->each(function (Channelvideo $c) use ($faker, $users) {
            $published_at = $faker->dateTimeInInterval('-4 days', '-3 days');
            $status = $faker->randomElement([0, 1, 2]);
            if ($status == 0) {
                $started_at = null;
            }
            if ($status == 1) {
                $started_at = $faker->dateTimeInInterval('-2 days', '-1 days');

            }
            if ($status == 2) {
                $started_at = $faker->dateTimeInInterval('-2 days', '-1 days');

            }

            $c->users()->attach(
                $users->random(rand(1, 3))->toArray(),
                [
                    'status' => $status,
                    'within_days' => 7, //$faker->randomElement([0, 1]),
                    'for_hours' => 24, //$faker->randomElement([0, 1]),
                    'started_at' => $started_at,

                    'published_at' => $published_at,
                    'created_at' => Date::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Date::now()->format('Y-m-d H:i:s'),
                ]
            );
        });

    }
}
