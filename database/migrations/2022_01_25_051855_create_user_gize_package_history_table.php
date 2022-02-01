<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGizePackageHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_gize_package_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_gize_package_id');
            $table->foreign('user_gize_package_id')->references('id')->on('user_gize_package');
            $table->float('unit_value_used')->nullable()->default(0);
            $table->string('for_model', 250)->nullable()->default('App\Models\Channelvideos');
            $table->unsignedBigInteger('model_id');
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
        Schema::dropIfExists('user_gize_package_history');
    }
}
