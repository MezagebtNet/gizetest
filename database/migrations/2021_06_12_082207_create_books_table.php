<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bookable_id')->constrained();
            $table->foreignId('book_language_id')->constrained();
            $table->foreignId('book_format_id')->constrained();
            $table->tinyInteger('edition_no')->nullable();
            $table->string('publisher')->nullable();
            $table->string('publish_year')->nullable();
            $table->string('publish_month')->nullable();
            $table->string('publish_date')->nullable();
            $table->integer('pages')->unsigned()->default(1);
            $table->string('translated_by')->nullable();
            $table->string('ISBN_13')->nullable();
            $table->string('ISBN_10')->nullable();

            // $table->timestamps();
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
        Schema::dropIfExists('books');
    }
}
