<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultiMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_media', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('title');
            $table->longText('description')->nullable();
            $table->enum('type', ['file', 'book', 'photo', 'audio', 'video']);
            $table->string('thumb')->nullable();
            $table->string('data')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multi_media');
    }
}
