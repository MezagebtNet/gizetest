<?php

namespace Database\Seeders;

use App\Models\Refund;
use Illuminate\Database\Seeder;

class RefundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $refund = [
            [
                'id' => 1,
                'claim_id' => 1,
            ],
            [
                'id' => 2,
                'claim_id' => 4,
            ],
            [
                'id' => 3,
                'claim_id' => 3,
            ],
            [
                'id' => 4,
                'claim_id' => 2,
            ],
        ];

        Refund::insert($refund);
    }
}
