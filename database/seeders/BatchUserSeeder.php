<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class BatchUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $batches = Batch::all();

        $users = User::all()->pluck('id');

        $batches->each(function (Batch $b) use ($faker, $users) {
            $b->users()->attach(
                $users->random(rand(1, 3))->toArray(),
                [
                    // 'user_id' => $faker->randomElement([1, 2, 3]),
                    'approved' => $faker->randomElement([0, 1]),
                    'active' => $faker->randomElement([0, 1]),
                    // 'method' => $faker->randomElement(['Cash', 'CBE', 'Abyssinia', 'CBE Birr', 'Dashen']),
                    // 'payment_date' => $faker->numberBetween(0, 3),
                    'created_at' => Date::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Date::now()->format('Y-m-d H:i:s'),
                ]
            );
        });

    }
}
