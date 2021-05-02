<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product__purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id')->nullable();

            $table->integer('product_id')->nullable();

            $table->integer('variant_id')->nullable();
            $table->double('qty')->nullable();
            $table->double('received')->nullable();
            $table->integer('purchase_unit_id')->nullable();
            $table->double('net_unit_cost')->nullable();
            $table->double('discount')->nullable();
            $table->double('tax_rate')->nullable();
            $table->double('tax')->nullable();
            $table->double('total')->nullable();
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
        Schema::dropIfExists('product__purchases');
    }
}