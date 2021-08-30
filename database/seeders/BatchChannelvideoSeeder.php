<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Channelvideo;
use App\Models\GizeChannel;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class BatchChannelvideoSeeder extends Seeder
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
        $gize_channel_ids = $gize_channels->pluck('id');

        foreach ($gize_channel_ids as $gize_channel_id) {
            $channelvideos = Channelvideo::where('gize_channel_id', $gize_channel_id)->get();
            $channelvideo_ids = $channelvideos->pluck('id');

            $batches = Batch::where('gize_channel_id', $gize_channel_id)->get();
            $batch_ids = $batches->pluck('id');

            foreach ($batches as $batch) {
                // $starts_at = $faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s');
                // $ends_at = Date::createFromFormat('Y-m-d H:i:s', $starts_at)->add('1 day')->format('Y-m-d H:i:s');

                $batch->channelvideos()->attach($channelvideo_ids,
                    [
                        'starts_at' => $starts_at = $faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s'),
                        'ends_at' => Date::createFromFormat('Y-m-d H:i:s', $starts_at)->add('1 day')->format('Y-m-d H:i:s'),
                    ]
                );

            }

        }

    }
}
