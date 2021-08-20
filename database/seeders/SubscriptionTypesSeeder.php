<?php

namespace Database\Seeders;

use App\Models\SubscriptionType;
use Illuminate\Database\Seeder;

class SubscriptionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $subscription_types = [
            [
                'id' => 1,
                'name' => 'Weekly',
                'description' => '',
            ],
            [
                'id' => 2,
                'name' => 'Monthly',
                'description' => '',
            ],
            [
                'id' => 3,
                'name' => 'Awudly',
                'description' => '',
            ],
            [
                'id' => 4,
                'name' => 'Yearly',
                'description' => '',
            ],
        ];

        SubscriptionType::insert($subscription_types);

    }
}
