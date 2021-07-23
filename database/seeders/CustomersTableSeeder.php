<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'id' => 1,
                'cliente' => '12345',
                'email' => 'one@gmail.com',
            ],
            [
                'id' => 2,
                'cliente' => '56789',
                'email' => 'seconed@gmail.com',
            ],
            [
                'id' => 3,
                'cliente' => '32052',
                'email' => 'other@gmail.com',
            ],
        ];

        Customer::insert($customers);
    }
}
