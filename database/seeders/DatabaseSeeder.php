<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([


            //Roles and Permissions
            RolesAndPermissionsSeeder::class,

            // PermissionsTableSeeder::class,
            // RolesTableSeeder::class,
            // PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            // RoleUserTableSeeder::class,
            CustomersTableSeeder::class,
            ServicesTableSeeder::class,
            // CitiesTableSeeder::class,
            // StatesTableSeeder::class,
            ClaimsServiceTableSeeder::class,
            RefundsTableSeeder::class,
            RefundServiceTableSeeder::class,

            BookAuthorsSeeder::class,

            //Factory Settings..
            FactorySettings\BookTypesSeeder::class,
            FactorySettings\BookGenresSeeder::class,
            FactorySettings\BookFormatsSeeder::class,
            FactorySettings\CurrenciesSeeder::class,
            FactorySettings\BookLanguagesSeeder::class,
            FactorySettings\BookRoyaltyRatesSeeder::class,

            //Book Data...
            BookData\BookSeriesSeeder::class,
            BookData\BookablesSeeder::class,
            BookData\BooksSeeder::class,
            BookData\BookPricesSeeder::class,



        ]);
    }
}
