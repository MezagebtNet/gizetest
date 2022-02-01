<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->string('code', 5)->nullable();
            $table->string('currency_name', 100)->nullable()->default('United States Dollar');
            $table->string('currency_code', 10)->nullable()->default('USD');
            $table->string('language_name', 10)->nullable()->default('English');
            $table->string('language_code', 10)->nullable()->default('en');
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
        Schema::dropIfExists('countries');
    }
}
