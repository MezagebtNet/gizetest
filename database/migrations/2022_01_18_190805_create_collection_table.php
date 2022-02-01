<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('collections')->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger('collection_type_id')->nullable()->default(null);
            $table->foreign('collection_type_id')->references('id')->on('collection_types');

            $table->string('title');
            $table->tinyInteger('within_days')->unsigned()->default(7); //days video will wait until activated (started to be watched)
            $table->tinyInteger('for_hours')->unsigned()->default(24); //hours video will be available for (once it is started to be watched)
            $table->string('duration');
            $table->float('unit_value')->nullable()->default(1); //if null get children unit_value sum
                //Can be considered as price. 1 = 50br = 4usd, 0.5 = 25br and so on
            $table->smallInteger('seriesable')->unsigned()->default(0); // 0 - no, 1 - yes
            $table->smallInteger('series_no')->unsigned()->default(1);
            $table->string('description', 250)->nullable()->default('text');

            $table->string('poster_image_url', 255)->nullable();
            $table->string('thumb_image_url', 255)->nullable();
            $table->tinyInteger('active')->default(1); // 0 - inactive, 1 - active
            $table->tinyInteger('is_featured')->default(0); // 0 - not featured, 1 - featured

            $table->string('slug')->nullable()->unique();

            $table->unsignedBigInteger('gize_channel_id')->nullable()->default(null);
            $table->foreign('gize_channel_id')->references('id')->on('gize_channels')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();
        });


        Schema::table('collections', function (Blueprint $table) {
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
