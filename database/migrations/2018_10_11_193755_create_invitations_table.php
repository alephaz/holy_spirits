<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('church_name');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('telephone_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('website')->nullable();
            $table->string('event_type')->nullable();
            $table->string('venue_capacity')->nullable();
            $table->string('expected_attendance')->nullable();
            $table->text('tentative_dates')->nullable();
            $table->longText('previous_event_details')->nullable();
            $table->longText('message')->nullable();
            $table->boolean('newsletter_subscription')->default(true);
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
        Schema::dropIfExists('invitations');
    }
}
