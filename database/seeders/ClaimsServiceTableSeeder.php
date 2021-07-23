<?php

namespace Database\Seeders;

use App\Models\Claim;
use Illuminate\Database\Seeder;

class ClaimsServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $claims = [
            [
                'id' => 1,
                'customer_id' => '1',
            ],
            [
                'id' => 2,
                'customer_id' => '2',
            ],
            [
                'id' => 3,
                'customer_id' => '2',
            ],
            [
                'id' => 4,
                'customer_id' => '3',
            ],
        ];

        Claim::insert($claims);
    }
}
