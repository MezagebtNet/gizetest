<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\SubscriptionType;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class BatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $batches = [
        //     [
        //         "id" => 1,
        //         "code" => "2013-02-04-01",
        //         "description" => "Batch Description 1",
        //         "start_date" => "2021-06-20 00:00:00",
        //         "status" => 1,
        //         'created_at' => Date::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Date::now()->format('Y-m-d H:i:s'),
        //     ],
        //     [
        //         "id" => 2,
        //         "code" => "2013-02-05-01",
        //         "description" => "Batch Description 2",
        //         "start_date" => "2021-07-20 00:00:00",
        //         "status" => 1,
        //         'created_at' => Date::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Date::now()->format('Y-m-d H:i:s'),
        //     ],
        //     [
        //         "id" => 3,
        //         "code" => "2013-02-06-01",
        //         "description" => "Batch Description 3",
        //         "start_date" => "2021-08-20 00:00:00",
        //         "status" => 1,
        //         'created_at' => Date::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Date::now()->format('Y-m-d H:i:s'),
        //     ],
        // ];

        // Batch::insert($batches);

        $faker = Faker::create();
        $users = User::all()->pluck('id');
        $subscription_type_ids = SubscriptionType::all()->pluck('id');

        for ($i = 1; $i <= 3; $i++) {
            $batch = Batch::create([
                "code_name" => $faker->unique()->slug(3), //"2013-02-06-01",
                "description" => $faker->sentence(2),
                "status" => $faker->randomElement([0, 1, 2, 3]),
                // "subscription_period_id" => $faker->numberBetween(0, 100),
                "starts_on_date" => $faker->dateTimeThisMonth('+12 days'),
                "payment_fee" => $faker->numberBetween(800, 1000),
                "currency" => $faker->randomElement(['ETB', 'USD']),
                'created_at' => Date::now()->format('Y-m-d H:i:s'),
                'updated_at' => Date::now()->format('Y-m-d H:i:s'),
                'subscription_type_id' => $faker->randomElement($subscription_type_ids),
            ]);

            // if (count($users)) {
            //     $batch->users()->sync($users->random(mt_rand(1, 3)));
            // }

        }
    }
}
