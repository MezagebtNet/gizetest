<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Started Websockets serve!");
        \Artisan::call("websockets:serve");

        // cd /home2/mezagebt/gizetest && php artisan test:cron > /dev/null 2>&1

        /*

        Write your database logic we bellow:

        User::create(['name'=>'test', 'email' => 'test@test.com']);

         */

        // return 0;
    }
}
