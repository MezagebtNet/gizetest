<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('code_name')->nullable()->unique();
            $table->string('description')->nullable();
            // $table->string('subscription_period_id')->nullable();
            $table->dateTime('starts_on_date')->nullable();
            $table->float('payment_fee')->nullable()->default(00.00);
            $table->string('currency')->nullable()->default('ETB');
            $table->tinyInteger('status')->nullable()->default(0); //0-Not-started, 1-Ongoing, 2-Onhold, 3-Closed

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batches');
    }
}
