<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rc')->unsigned()->nullable();
            $table->string('from_location');
            $table->string('to_location');
            $table->date('booking_date');
            $table->date('departure_date');
            $table->string('passenger_name');
            $table->string('passenger_contact_1');
            $table->string('passenger_contact_2')->nullable();
            $table->string('email')->nullable();
            $table->time('reporting_time');
            $table->time('departure_time');
            $table->string('sleeper_no')->nullable();
            $table->string('seat_no')->nullable();
            $table->integer('bus_no');
            $table->integer('total_seats');
            $table->integer('amount');
            $table->integer('advance');
            $table->boolean('is_cancel')->default(false);
            $table->integer('balance')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('pickup_point_id')->unsigned();
            $table->bigInteger('partner_travel_id')->unsigned();


            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
            $table->foreign('pickup_point_id')->references('id')->on('pickup_points')->onDelete('no action')->onUpdate('no action');
            $table->foreign('partner_travel_id')->references('id')->on('partner_travels')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
