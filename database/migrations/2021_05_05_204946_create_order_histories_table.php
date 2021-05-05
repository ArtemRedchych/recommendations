<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_histories', function (Blueprint $table) {
            $table->bigInteger('number_order');
            $table->bigInteger('id_products');
            $table->bigInteger('amount');
            $table->double('orderpricedph', 15, 8)->nullable()->default(0);

            $table->foreign('number_order')->references('number_order')->on('order_processes');
            $table->foreign('id_products')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_histories');
    }
}
