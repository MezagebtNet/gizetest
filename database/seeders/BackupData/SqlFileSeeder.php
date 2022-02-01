<?php

namespace Database\Seeders\BackupData;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SqlFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('sql/1_31_2022_db_1.sql');
        $sql = file_get_contents($path);
        $path = public_path('sql/1_31_2022_db_3.sql');

        $sql = file_get_contents($path);
        $path = public_path('sql/1_31_2022_db_2.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);

    }
}
