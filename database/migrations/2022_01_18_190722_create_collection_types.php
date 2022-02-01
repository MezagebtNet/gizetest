<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('collection_types')->onUpdate('cascade')->onDelete('set null');
            $table->string('plural_name', 250)->nullable();
            $table->string('plural_name_en', 250)->nullable();
            $table->string('singular_name', 250)->nullable();
            $table->string('singular_name_en', 250)->nullable();
            // $table->tinyInteger('seriesable')->default(0); //0 - no ,1 - yes
            $table->string('description', 250)->nullable()->default('text');
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
        Schema::dropIfExists('collection_types');
    }
}
