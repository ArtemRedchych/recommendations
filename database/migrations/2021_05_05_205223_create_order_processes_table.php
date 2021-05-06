<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_processes', function (Blueprint $table) {
            $table->bigInteger('number_order');
            $table->bigInteger('id_customers');
            $table->string('created',20)->nullable();
            $table->double('final_price', 15, 8)->nullable()->default(0);

            //$table->foreign('id_customers')->references('id')->on('custommers');
            $table->dropForeign('id_customers');
            $table->primary('number_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_processes');
    }
}

SELECT *
  FROM information_schema.columns
 WHERE  table_name   = 'products'
     ;