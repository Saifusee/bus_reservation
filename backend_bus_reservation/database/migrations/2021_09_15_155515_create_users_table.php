<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('email_verified')->default(false);
            $table->string('password');
            $table->bigInteger('contact_1')->nullable();
            $table->bigInteger('contact_2')->nullable();
            $table->bigInteger('contact_3')->nullable();
            $table->bigInteger('contact_4')->nullable();
            $table->string('greetings')->nullable();
            $table->longText('note_1')->nullable();
            $table->longText('note_2')->nullable();
            $table->longText('terms_and_c0nditions')->nullable();
            $table->boolean('isadmin')->default(false);
            $table->mediumText('remember_token')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
