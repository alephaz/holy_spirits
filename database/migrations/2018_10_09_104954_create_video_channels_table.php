<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('title');
            $table->string('machine_name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->integer('weight')->unsigned();
            $table->boolean('display_in_menu')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('role_video_channel', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('video_channel_id')->unsigned();
            $table->primary(['video_channel_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_video_channel');
        Schema::dropIfExists('video_channels');
    }
}
