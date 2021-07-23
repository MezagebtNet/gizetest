<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id' => 1,
                'title' => 'user_access',
            ],
            [
                'id' => 2,
                'title' => 'task_access',
            ],
            // [
            //     'id'    => 3,
            //     'title' => 'system_setting',
            // ],
            // [
            //     'id'    => 4,
            //     'title' => 'system_user',
            // ],
            // [
            //     'id'    => 4,
            //     'title' => 'manage_book_data',
            // ],
            // [
            //     'id'    => 5,
            //     'title' => 'manage_shop_data',
            // ],
            // [
            //     'id'    => 6,
            //     'title' => 'manage_author_detail',
            // ],
            // [
            //     'id'    => 5,
            //     'title' => 'manage_shop_detail',
            // ],

            // [
            //     'id' => 3,
            //     'title' => 'system_user',
            // ],
            // [
            //     'id' => 4,
            //     'title' => 'system_setting',
            // ],
            [
                'id' => 5,
                'title' => 'system_account_activate_user',
            ],

            [
                'id' => 6,
                'title' => 'manage_author_subscription',
            ],
            [
                'id' => 7,
                'title' => 'manage_shop_subscription',
            ],
            [
                'id' => 8,
                'title' => 'manage_agent_subscription',
            ],

            [
                'id' => 9,
                'title' => 'shop_data',
            ],
            [
                'id' => 10,
                'title' => 'shop_agent_assignment',
            ],

            [
                'id' => 11,
                'title' => 'author_data',
            ],
            [
                'id' => 12,
                'title' => 'author_asign_shop',
            ],
            [
                'id' => 13,
                'title' => 'author_activate_account',
            ],
        ];

        Permission::insert($permissions);
    }
}
