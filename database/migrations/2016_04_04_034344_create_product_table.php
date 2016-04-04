<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('product_name');
            $table->text('product_sort_description');
            $table->text('product_description');
            $table->integer('price_RPP');
            $table->integer('price_discount');
            $table->string('product_thumbnail');
            $table->string('product_images');
            $table->datetime('created_at');
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
        Schema::drop('product');
    }
}
