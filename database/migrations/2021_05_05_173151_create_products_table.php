<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('id_category')->nullable();
            $table->string('title', 100)->nullable();
            $table->string('author', 100)->nullable();
            $table->string('publisher', 100)->nullable();
            $table->double('price', 15, 8)->nullable()->default(0);
            $table->bigInteger('dph');
            $table->bigInteger('availability');

            $table->primary('id');
            $table->foreign('id_category')->references('id')->on('category');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
