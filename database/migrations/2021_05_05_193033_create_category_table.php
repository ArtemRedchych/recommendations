<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('subcategory');
            $table->string('title', 100)->nullable();
            $table->string('description', 512)->nullable();
            $table->smallInteger('active')->nullable()->default(0);
            $table->bigInteger('cat_link_to_category_id')->nullable()->default(null);
            
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
