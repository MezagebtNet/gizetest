<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGizePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gize_packages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->nullable()->default('');
            $table->integer('months')->unsigned()->nullable()->default(1);
            $table->float('for_unit_values')->unsigned()->nullable()->default(1);
            $table->float('etb_amount')->nullable()->default(0);
            $table->float('usd_amount')->nullable()->default(0);
            $table->string('feature_description', 250)->nullable()->default('');
            $table->tinyInteger('active')->default(0);
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
        Schema::dropIfExists('gize_packages');
    }
}
