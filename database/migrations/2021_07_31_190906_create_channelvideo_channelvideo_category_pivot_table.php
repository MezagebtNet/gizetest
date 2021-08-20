<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelvideoChannelvideoCategoryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('channelvideo_channelvideo_category', function (Blueprint $table) {
            $table->bigInteger('channelvideo_id')->unsigned()->nullable();
            $table->foreign('channelvideo_id', 'cvid_fk')->references('id')->on('channelvideos')->onDelete('set null');
            $table->bigInteger('channelvideo_category_id')->unsigned()->nullable();
            $table->foreign('channelvideo_category_id', 'cvid_c_fk')->references('id')->on('channelvideo_categories')->onDelete('set null');
            // $table->primary(['channelvideo_id', 'channelvideo_category_id']);
        });

        // Schema::table('channelvideo_channelvideo_category', function (Blueprint $table) {
        //     $table->foreignId('channelvideo_id')->constrained('channelvideos')->onDelete('cascade');
        //     $table->foreignId('channelvideo_category_id')->constrained('channelvideo_categories')->onDelete('cascade');
        //     // $table->foreign('channelvideo_id')->references('id')->on('channelvideos')->onDelete('cascade');
        //     // $table->unsignedInteger('channelvideo_category_id');
        //     // $table->foreign('channelvideo_category_id')->references('id')->on('channelvideo_categories')->onDelete('cascade');

        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channelvideo_channelvideo_category');
    }
}
