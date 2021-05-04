->nullable()<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('reference_no')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('Customer_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('biller_id')->nullable();
            $table->integer('item')->nullable();
            $table->double('total_qty')->nullable();
            $table->double('total_discount')->nullable();
            $table->double('total_tax')->nullable();
            $table->double('total_price')->nullable();
            $table->double('grand_total')->nullable();
            $table->double('order_tax_rate')->nullable();
            $table->double('order_tax')->nullable();
            $table->double('order_discount')->nullable();
            $table->integer('cupon_id')->nullable();
            $table->double('cupon_discount')->nullable();
            $table->double('shipping_cost')->nullable();
            $table->integer('sale_status')->nullable();
            $table->integer('payment_status')->nullable();
            $table->string('document')->nullable();
            $table->double('paid_amount')->nullable();
            $table->text('sale_note')->nullable();
            $table->text('staff_note')->nullable();
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
        Schema::dropIfExists('sales');
    }
}