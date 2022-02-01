<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToChannelvideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('channelvideos', function (Blueprint $table) {
            $table->tinyInteger('is_in_collection')->default(2)->comment('0 - is standalone, 1 - is part of collection, 2 - is both standalone and part of collection');
            $table->tinyInteger('part_no')->nullable()->unsigned()->default(0);
            $table->float('unit_value')->default(1); //Can be considered as price. 1 = 50br = 4usd, 0.5 = 25br and so on
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('channelvideos', function (Blueprint $table) {
            $table->dropColumn(
                'is_in_collection', //0 - is standalone, 1 - is part of collection, 2 - is both standalone and part of collection
                'part_no',
                'unit_value',
            );
        });
    }
}
