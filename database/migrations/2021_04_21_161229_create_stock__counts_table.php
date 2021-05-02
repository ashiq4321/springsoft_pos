<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock__counts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
             $table->string('reference_no')->nullable();
             $table->integer('warehouse_id')->nullable();
                 $table->string('type');
             $table->string('category_id')->nullable();
              $table->string('brand_id')->nullable();
              
           
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
        Schema::dropIfExists('stock__counts');
    }
}
