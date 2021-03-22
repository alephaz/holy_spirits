<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewslettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->enum('language', [
                'en',
                'es',
                'neutral'
            ]);

            $table->string('block_a_title')->nullable();
            $table->text('block_a_body')->nullable();
            $table->integer('block_a_video')->unsigned()->nullable();
            $table->string('block_a_link')->nullable();

            $table->string('block_b_title')->nullable();
            $table->text('block_b_body')->nullable();
            $table->integer('block_b_video')->unsigned()->nullable();
            $table->string('block_b_link')->nullable();

            $table->string('block_c_title')->nullable();
            $table->text('block_c_body')->nullable();
            $table->integer('block_c_video')->unsigned()->nullable();
            $table->string('block_c_link')->nullable();

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
        Schema::dropIfExists('newsletters');
    }
}
