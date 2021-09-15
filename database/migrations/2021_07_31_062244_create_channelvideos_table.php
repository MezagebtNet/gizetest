<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelvideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channelvideos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('trainer');
            $table->string('duration');
$table->string('host');


            $table->float('price')->default(0);
            $table->longText('description')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('file_url', 255)->nullable();
$table->tinyInteger('hls_uploaded')->default(1);
$table->tinyInteger('keys_uploaded')->default(1);


            $table->string('storage_disk', 255)->nullable(); // google, s3, etc...
            $table->tinyInteger('file_type')->default(0); // 0 - mp4, 1 - other
            $table->string('sample_file_url', 255)->nullable();
            $table->tinyInteger('sample_file_type')->default(0); // 0 - mp4, 1 - other
            $table->string('poster_image_url', 255)->nullable();
            $table->string('thumb_image_url', 255)->nullable();
            $table->tinyInteger('active')->default(0); // 0 - inactive, 1 - active
$table->tinyInteger('video_available_for')->default(1); //0 - public, 1 - batches only
$table->tinyInteger('is_free')->default(1); //0 - Not Free, 1 - Free


            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('channelvideos', function (Blueprint $table) {
            $table->foreignId('gize_channel_id')->unsigned()->nullable()->constrained('gize_channels')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channelvideos');
    }
}
