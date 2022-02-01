<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelvideoCollectionPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channelvideo_collection', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::table('channelvideo_collection', function (Blueprint $table) {
            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->unsignedBigInteger('channelvideo_id');
            $table->foreign('channelvideo_id')->references('id')->on('channelvideos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channelvideo_collection');
    }
}
