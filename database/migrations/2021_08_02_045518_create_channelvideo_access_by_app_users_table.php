<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelvideoAccessByAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channelvideo_access_by_app_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('channelvideo_id');
            $table->tinyInteger('revoked')->default(1); // 0 - no, 1 - yes

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
        Schema::dropIfExists('channelvideo_access_by_app_users');
    }
}
