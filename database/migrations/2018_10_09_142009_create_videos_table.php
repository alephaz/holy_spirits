<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('language', [
                'neutral',
                'en',
                'es'
            ])->default('es');
            $table->longText('title');
            $table->longText('description')->nullable();
            $table->string('slug')->nullable();
            $table->string('youtube_image')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('custom_video_image')->nullable();
            $table->string('video_link')->nullable();
            $table->enum('type', [
                'youtube',
                'custom'
            ])->default('youtube');
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->integer('weight')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('video_video_channel', function (Blueprint $table) {
            $table->integer('video_id')->unsigned();
            $table->integer('video_channel_id')->unsigned();
            $table->primary(['video_channel_id', 'video_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_video_channel');
        Schema::dropIfExists('videos');
    }
}
