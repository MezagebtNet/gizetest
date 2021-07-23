<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRoyaltyRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = Carbon::now();

        Schema::create('book_royalty_rate', function (Blueprint $table) use ($now) {
            $table->id();
            $table->foreignId('book_format_id')->constrained('book_formats')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('currency_id')->constrained('currencies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('rate')->nullable()->default(0.0);
            $table->dateTime('published_at')->nullable()->default($now);
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
        Schema::dropIfExists('book_royalty_rate');
    }
}
