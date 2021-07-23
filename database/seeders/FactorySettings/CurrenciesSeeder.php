<?php

namespace Database\Seeders\FactorySettings;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'id' => 1,
                'currency_name' => 'Ethiopian Birr',
                'currency_code' => 'ETB',
            ],
            [
                'id' => 2,
                'currency_name' => 'United States Dollar',
                'currency_code' => 'USD',
            ],
        ];

        Currency::insert($currencies);
    }
}
