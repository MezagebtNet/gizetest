<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('slug')->nullable()->unique();
            $table->longText('description')->nullable();
            // $table->bigInteger('channel_category_id')->nullable();
            // $table->foreignId('channel_category_id')->unsigned()->nullable()->constrained('channel_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::table('channel_categories', function (Blueprint $table) {
            $table->foreignId('channel_category_id')->nullable()->constrained('channel_categories')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_categories');
    }
}
