<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('media', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('media_name');
            $table->string('media_directory');
            $table->string('media_directory_url');
            $table->string('media_full_url');
            $table->string('media_size');
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
        //
    }
}
