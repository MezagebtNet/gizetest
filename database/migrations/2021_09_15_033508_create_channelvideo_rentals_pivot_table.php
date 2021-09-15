<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelvideoRentalsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channelvideo_rentals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('channelvideo_id');
            $table->foreign('channelvideo_id')->references('id')->on('channelvideos');
            $table->tinyInteger('status'); //0 - not_watched, 1 - started_watching, 2 - completed_watching
            $table->tinyInteger('within_days')->unsigned()->default(7); //days video will wait until activated (started to be watched)
            $table->tinyInteger('for_hours')->unsigned()->default(24); //hours video will be available for (once it is started to be watched)
            $table->dateTime('started_at')->nullable(); //user has started watching at...
            $table->dateTime('published_at'); //rent starting datetime...
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channelvideo_rentals');
    }
}
