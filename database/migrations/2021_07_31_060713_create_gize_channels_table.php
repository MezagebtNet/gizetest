<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGizeChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gize_channels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('name_en', 100)->nullable();

            // $table->string('name_en', 100)->nullable();

            $table->string('slug')->nullable()->unique();
            $table->string('producer', 100)->nullable();
            // $table->string('host', 100)->nullable();
            $table->string('banner_image_url', 255)->nullable();
            $table->string('logo_image_url', 255)->nullable();


            $table->longText('description', 100)->nullable();
            $table->longText('contact_address', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('batches', function (Blueprint $table) {
            $table->unsignedBigInteger('gize_channel_id');
            $table->foreign('gize_channel_id')->references('id')->on('gize_channels');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gize_channels');
    }
}
