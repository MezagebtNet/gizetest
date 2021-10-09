<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\ScheduledVideoStarted;
use App\Models\User;
use App\Models\BatchChannelvideo;

class ScheduledVideoNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:started_scheduled_videos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies Scheduled Videos for users';

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
        // \Artisan::call("websockets:serve");
        \Log::info("Scheduled Video Notifications Sent!");

        ScheduledVideoStarted::dispatch(User::find(2), BatchChannelvideo::find(1));


        // cd /home2/mezagebt/gizetest && php artisan test:cron > /dev/null 2>&1

        /*

        Write your database logic we bellow:

        User::create(['name'=>'test', 'email' => 'test@test.com']);

         */

        // return 0;
    }
}
