<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Setting;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('currency')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('staff_access')->nullable();
            $table->string('currency_position')->nullable();
            $table->string('copy_write')->nullable();
            $table->string('app_version')->nullable();
            $table->timestamps();
        });

        Setting::create([
            'site_name' => 'SpringSoft POS',
            'site_logo' => 'photo.jpg',
            'currency' => 'BDT',
            'time_zone' => 'Asia/Dhaka',
            'staff_access' => 'own',
            'currency_position' => 'prefix',
            'copy_write' => 'SpringSoft-IT',
            'app_version' => 'version 1.0'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}