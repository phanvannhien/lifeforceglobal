<?php

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
            $table->increments('id');
            $table->string('name');
            $table->string('name_suffix',10);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_code');
            $table->integer('user_refferal');
            $table->dateTime('registration_date');
            $table->integer('user_status')->default(0);
            $table->integer('register_fee')->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
