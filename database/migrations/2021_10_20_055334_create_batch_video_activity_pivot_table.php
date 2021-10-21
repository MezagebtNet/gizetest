<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchVideoActivityPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_video_activity', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status'); //0 - not_watched, 1 - started_watching, 2 - completed_watching
            $table->dateTime('started_at')->nullable(); //user has started watching at...
            $table->string('user_agent', 255)->nullable();
            $table->string('ip_address', 20)->nullable();
            $table->tinyInteger('view_count')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::table('batch_video_activity', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('batch_channelvideo_id');
            $table->foreign('batch_channelvideo_id')->references('id')->on('batch_channelvideo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_video_activity');
    }
}
