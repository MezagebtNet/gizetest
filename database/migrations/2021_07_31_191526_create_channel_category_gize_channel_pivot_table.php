<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelCategoryGizeChannelPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_category_gize_channel', function (Blueprint $table) {
            $table->unsignedBigInteger('gize_channel_id');
            $table->foreign('gize_channel_id')->references('id')->on('gize_channels')->onDelete('cascade');
            $table->unsignedBigInteger('channel_category_id');
            $table->foreign('channel_category_id')->references('id')->on('channel_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_category_gize_channel');
    }
}
