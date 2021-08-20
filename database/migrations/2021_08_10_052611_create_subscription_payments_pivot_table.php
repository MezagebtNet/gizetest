<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPaymentsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();

            // $table->bigInteger('user_id')->nullable();
            $table->float('amount')->nullable()->default(0.00);
            $table->string('reciept_no', 100)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('method', 100)->nullable(); // (cash, CBE, paypal, CBE Birr, ...)
            $table->timestamps();

        });

        Schema::table('subscription_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_user_id');
            $table->foreign('batch_user_id')->references('id')->on('batch_user');
            $table->unsignedBigInteger('subscription_period_id');
            $table->foreign('subscription_period_id')->references('id')->on('subscription_periods');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_payments');
    }
}
