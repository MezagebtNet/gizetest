<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_periods', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('subscription_type_id')->unsigned()->nullable();
            // $table->string('year', 4)->nullable(); // 'YYYY'
            $table->tinyInteger('period_no')->unsigned()->nullable()->default(1);
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->timestamps();
        });

        Schema::table('subscription_periods', function (Blueprint $table) {
            $table->foreignId('batch_id')->nullable()->constrained('batches')->onDelete('cascade');
            // $table->unsignedBigInteger('subscription_type_id');
            // $table->foreign('subscription_type_id')->references('id')->on('subscription_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_periods');
    }
}
