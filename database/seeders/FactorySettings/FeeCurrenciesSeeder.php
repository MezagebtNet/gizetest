<?php

namespace Database\Seeders\FactorySettings;

use App\Models\FeeCurrency;
use Illuminate\Database\Seeder;
use Jenssegers\Date\Date;

class FeeCurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fee_currencies = [
            [
                'id' => 1,
                'currency_name' => 'Ethiopian Birr',
                'currency_code' => 'ETB',
                'created_at' => Date::now()->format('Y-m-d H:i:s'),
                'updated_at' => Date::now()->format('Y-m-d H:i:s'),

            ],
            [
                'id' => 2,
                'currency_name' => 'United States Dollar',
                'currency_code' => 'USD',
                'created_at' => Date::now()->format('Y-m-d H:i:s'),
                'updated_at' => Date::now()->format('Y-m-d H:i:s'),
            ],
        ];

        FeeCurrency::insert($fee_currencies);
    }
}
