<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\BatchUser;
use App\Models\SubscriptionPeriod;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class SubscriptionPeriodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $batches = Batch::all();
        $faker = Faker::create();
        $subscription_periods = [];

        foreach ($batches as $batch) {
            for ($i = 1; $i <= $faker->randomElement([8, 4, 1, 3]); $i++) {

                array_push($subscription_periods,
                    [
                        "period_no" => $i,
                        "from_date" => $faker->date(),
                        "to_date" => $faker->date(),
                        'created_at' => Date::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Date::now()->format('Y-m-d H:i:s'),
                        'batch_id' => $batch->id,
                    ]);
            }
        }

        SubscriptionPeriod::insert($subscription_periods);

        $subscription_periods = SubscriptionPeriod::all()->pluck('id');
        $batch_users = BatchUser::all();
        foreach ($batch_users as $batch_user) {
            $subscription_period_id = $faker->randomElement($subscription_periods);
            $subscription_period = SubscriptionPeriod::find($subscription_period_id);
            $subscription_period->subscribers()->syncWithPivotValues(
                $batch_user->pluck('id'),
                [
                    "amount" => $faker->randomElement([100, 200, 800, 650, 200]),
                    'reciept_no' => $faker->regexify('[T-T]{2}[0-4]{8}'),
                    'method' => $faker->randomElement(['Cash', 'CBE', 'Abyssinia', 'CBE Birr', 'Dashen']),
                    'payment_date' => $faker->date(),
                    'created_at' => Date::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Date::now()->format('Y-m-d H:i:s'),
                ]
            );
        }

    }
}
