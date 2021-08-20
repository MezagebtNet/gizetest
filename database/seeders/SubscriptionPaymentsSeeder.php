<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\BatchUser;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class SubscriptionPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        // $batch_users = BatchUser::all();
        // $users = User::all()->pluck('id');
        $users->each(function (User $user) use ($faker) {

            //get batchuser related subscription periods
            $user_subscriptions = BatchUser::where('user_id', $user->id)->get();
            $batch_user_ids = $user_subscriptions->pluck('id');
            $user_subscriptions->each(function (BatchUser $s) use ($user, $batch_user_ids, $faker) {
                $batch = Batch::where('id', $s->batch_id);
                $batch_payment_fee = $batch->value('payment_fee');
                $max_periods = $s->max_period_no;
                foreach ([1, 3, 6] as $max_period) {

                    foreach ($faker->randomElements($batch_user_ids, 1) as $batch_user_id) {
                        $s->subscriptionPeriods()->where('period_no', 1)->attach($batch_user_id,
                            [
                                // 'user_id' => $user->id,
                                'amount' => $batch_payment_fee, //$faker->randomElement([800, 850]),
                                'reciept_no' => $faker->regexify('[T-T]{2}[0-4]{8}'),
                                'method' => $faker->randomElement(['Cash', 'CBE', 'Abyssinia', 'CBE Birr', 'Dashen']),
                                'payment_date' => $faker->date(),
                                'created_at' => Date::now()->format('Y-m-d H:i:s'),
                                'updated_at' => Date::now()->format('Y-m-d H:i:s'),
                            ]
                        );
                    }

                }

            });

            // $subscription_period_ids = SubscriptionPeriod::all()->pluck('id');

            // $user->subscriptionPeriods()->attach($subscription_period_ids);
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
