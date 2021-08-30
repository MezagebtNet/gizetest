<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'firstname'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'lastname'       => '',
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'firstname'           => 'User',
                'email'          => 'user@user.com',
                'password'       => bcrypt('password'),
                'lastname'       => '',
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'firstname'           => 'Girum',
                'email'          => '4girum@gmail.com',
                'password'       => bcrypt('12345678'),
                'lastname'       => '',
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'firstname'      => 'User2',
                'email'          => 'user2@user.com',
                'password'       => bcrypt('password'),
                'lastname'       => '',
                'remember_token' => null,
            ],
            [
                'id'             => 5,
                'firstname'      => 'User3',
                'email'          => 'user3@user.com',
                'password'       => bcrypt('password'),
                'lastname'       => '',
                'remember_token' => null,
            ],
        ];

        User::insert($users);


        $user = User::find(1);
        $user->assignRole('user');

        $user = User::find(2);
        $user->assignRole('channel-admin');

        $user = User::find(3);
        $user->assignRole('super-admin');

        $user = User::find(4);
        $user->assignRole('system-admin');
        $user->assignRole('channel-admin');

        $user = User::find(5);
        $user->assignRole('user');
        $user->assignRole('channel-admin');

    }
}
