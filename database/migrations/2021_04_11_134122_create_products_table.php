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
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('barcode_symbology')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('purchase_unit_id')->nullable();
            $table->integer('sale_unit_id')->nullable();
            $table->double('cost')->nullable();
            $table->double('price')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('alert_quantity')->nullable();
            $table->integer('promotion')->nullable();
            $table->double('promotion_price')->nullable();
            $table->string('starting_date')->nullable();
            $table->string('last_date')->nullable();
            $table->integer('tax_id')->nullable();
            $table->integer('tax_method')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->integer('is_variant')->nullable();
            $table->integer('featured')->nullable();
            $table->string('product_list')->nullable();
            $table->string('qty_list')->nullable();
            $table->string('price_list')->nullable();
            $table->text('product_details')->nullable();
            $table->integer('is_active')->nullable();
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
        Schema::dropIfExists('products');
    }
}