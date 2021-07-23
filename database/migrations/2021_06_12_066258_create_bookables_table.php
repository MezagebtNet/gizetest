<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookables', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->nullable()->default('');
            $table->foreignId('book_author_id')->constrained('book_authors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('book_genre_id')->constrained('book_genres')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('seriesable')->default(0);
            $table->tinyInteger('series_no')->nullable();
            $table->foreignId('book_series_id')->nullable()->constrained('book_series');
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
        Schema::dropIfExists('bookables');
    }
}
