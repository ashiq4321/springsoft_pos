<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->nullable();
            $table->Integer('user_id');
            $table->Integer('warehouse_id');
            $table->Integer('supplier_id');
            $table->Integer('item');
            $table->Double('total_qty');
            $table->Double('total_discount');
            $table->Double('total_tax');
            $table->Double('total_cost');
            $table->Double('order_tax_rate');
            $table->Double('order_tax')->nullable();
            $table->Double('order_discount');
            $table->Double('shipping_cost');
            $table->Double('grand_total');
            $table->Double('paid_amount');
            $table->Integer('status');
            $table->Integer('payment_status');
            $table->string('document')->nullable();
            $table->Text('note')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}