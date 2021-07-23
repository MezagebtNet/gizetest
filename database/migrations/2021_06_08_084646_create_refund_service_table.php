<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_service', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('refund_id')->constrained();
            $table->foreignId('service_id')->constrained();
            // $table->unsignedBigInteger('refund_id')->index();
            // $table->foreign('refund_id')->references('id')->on('refunds')->onDelete('cascade');
            // $table->unsignedBigInteger('service_id')->index();
            // $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            // $table->primary(['refund_id', 'service_id']);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refund_service');
    }
}
