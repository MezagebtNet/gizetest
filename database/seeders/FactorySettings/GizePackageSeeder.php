<?php

namespace Database\Seeders\FactorySettings;

use Illuminate\Database\Seeder;
use App\Models\GizePackage;


class GizePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gize_packages = [

            [
                'months' => 1,
                'code' => 'M1-1',
                'for_unit_values' => 12,
                'etb_amount' => 600,
                'usd_amount' => 50,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 1,
                'code' => 'M1-2',
                'for_unit_values' => 20,
                'etb_amount' => 800,
                'usd_amount' => 66.7,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 1,
                'code' => 'M1-3',
                'for_unit_values' => 33,
                'etb_amount' => 1000,
                'usd_amount' => 83.3,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 1,
                'code' => 'M1-4',
                'for_unit_values' => 48,
                'etb_amount' => 1200,
                'usd_amount' => 100,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 2,
                'code' => 'M2-1',
                'for_unit_values' => 20,
                'etb_amount' => 1000,
                'usd_amount' => 83.3,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 2,
                'code' => 'M2-2',
                'for_unit_values' => 30,
                'etb_amount' => 1200,
                'usd_amount' => 100,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 2,
                'code' => 'M2-3',
                'for_unit_values' => 47,
                'etb_amount' => 1400,
                'usd_amount' => 116.7,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 2,
                'code' => 'M2-4',
                'for_unit_values' => 64,
                'etb_amount' => 1600,
                'usd_amount' => 133.4,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 3,
                'code' => 'M3-1',
                'for_unit_values' => 28,
                'etb_amount' => 1400,
                'usd_amount' => 116.7,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 3,
                'code' => 'M3-2',
                'for_unit_values' => 40,
                'etb_amount' => 1600,
                'usd_amount' => 133.4,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 3,
                'code' => 'M3-3',
                'for_unit_values' => 60,
                'etb_amount' => 1800,
                'usd_amount' => 150,
                'feature_description' => '',
                'active' => 1

            ],
            [
                'months' => 3,
                'code' => 'M3-4',
                'for_unit_values' => 80,
                'etb_amount' => 2000,
                'usd_amount' => 166.7,
                'feature_description' => '',
                'active' => 1
            ],

        ];

        foreach ($gize_packages as $key => $value) {

            GizePackage::create($value);

        }
    }
}
