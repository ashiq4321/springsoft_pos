<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjusmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjusments', function (Blueprint $table) {
            $table->id();
            
             $table->string('reference_id')->nullable();
             $table->integer('warehouse_id')->nullable();
             $table->string('document')->nullable();
              $table->integer('total_qty')->nullable();
               $table->string('note');
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
        Schema::dropIfExists('adjusments');
    }
}
