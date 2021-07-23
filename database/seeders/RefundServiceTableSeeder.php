<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefundServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('refund_service')->insert(array(
            array('refund_id' => 1, 'service_id' => 2),
            array('refund_id' => 2, 'service_id' => 1),
            array('refund_id' => 3, 'service_id' => 1),
            array('refund_id' => 4, 'service_id' => 1)));
    }
}
