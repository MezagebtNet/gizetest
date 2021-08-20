<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\SubscriptionPeriod;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BatchSubscriptionPeriodsSeeder extends Seeder
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
        // $users = User::all()->pluck('id');
        $subscription_period_ids = SubscriptionPeriod::all()->pluck('id');
        $batches->each(function (Batch $b) use ($faker, $subscription_period_ids) {
            $b->subscriptionPeriods()->attach($subscription_period_ids);
        });

        // $batches->each(function (Batch $b) use ($subscription_period, $faker, $users) {
        //     $b->subscription_periods()->attach(
        //         $subscription_period->random(rand(5, 10))->toArray(),
        //         [
        //             'user_id' => $faker->randomElement([1, 2, 3]),
        //             'amount' => $faker->randomElement([800, 850]),
        //             'reciept_no' => $faker->regexify('[T-T]{2}[0-4]{8}'),
        //             'method' => $faker->randomElement(['Cash', 'CBE', 'Abyssinia', 'CBE Birr', 'Dashen']),
        //             'payment_date' => $faker->numberBetween(0, 3),
        //             'created_at' => Date::now()->format('Y-m-d H:i:s'),
        //             'updated_at' => Date::now()->format('Y-m-d H:i:s'),
        //         ]
        //     );
        // });

    }
}
