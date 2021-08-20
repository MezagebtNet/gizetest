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

            UsersTableSeeder::class,

            // CustomersTableSeeder::class,
            // ServicesTableSeeder::class,

            // ClaimsServiceTableSeeder::class,
            // RefundsTableSeeder::class,
            // RefundServiceTableSeeder::class,

            // BookAuthorsSeeder::class,
            SubscriptionTypesSeeder::class,

            BatchesSeeder::class,

            ChannelCategoriesSeeder::class,

            ChannelvideoCategorySeeder::class,

            GizeChannelsTableSeeder::class,

            ChannelvideosTableSeeder::class,


            BatchUserSeeder::class,

            SubscriptionPeriodsSeeder::class,
            // BatchSubscriptionPeriodsSeeder::class,


            // SubscriptionPaymentsSeeder::class,

            //Factory Settings..
            // FactorySettings\BookTypesSeeder::class,
            // FactorySettings\BookGenresSeeder::class,
            // FactorySettings\BookFormatsSeeder::class,
            // FactorySettings\CurrenciesSeeder::class,
            // FactorySettings\BookLanguagesSeeder::class,
            // FactorySettings\BookRoyaltyRatesSeeder::class,

            FactorySettings\CurrenciesSeeder::class,

            //Book Data...
            // BookData\BookSeriesSeeder::class,
            // BookData\BookablesSeeder::class,
            // BookData\BooksSeeder::class,
            // BookData\BookPricesSeeder::class,



        ]);
    }
}
