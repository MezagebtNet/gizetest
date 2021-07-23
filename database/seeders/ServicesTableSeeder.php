<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = [
            [
                'id' => 1,
                'name' => 'Service 1',
            ],
            [
                'id' => 2,
                'name' => 'Service 2',
            ],
            [
                'id' => 3,
                'name' => 'Service 3',
            ],
        ];

        Service::insert($service);
    }
}
