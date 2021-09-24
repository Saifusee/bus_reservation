<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_travels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('partner_travel_name');
            $table->string('email_1');
            $table->string('email_2')->nullable();
            $table->string('address');
            $table->text('description')->nullable();
            $table->string('contact_1');
            $table->string('contact_2');
            $table->string('contact_3')->nullable();
            $table->string('contact_4')->nullable();
            $table->string('contact_5')->nullable();
            $table->string('contact_6')->nullable();
            $table->string('contact_7')->nullable();
            $table->string('contact_8')->nullable();
            $table->string('contact_9')->nullable();
            $table->string('contact_10')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_travels');
    }
}
