<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giftcards', function (Blueprint $table) {
            $table->id();
            $table->string('card');
            $table->double('amount');
            $table->double('expense')->nullable();
            $table->Integer('customer_id')->nullable();
            $table->Integer('user_id')->nullable();
            $table->date('expired_date')->nullable();
            $table->Integer('created_by')->nullable();
            $table->boolean('is_active')->nullable();

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
        Schema::dropIfExists('giftcards');
    }
}