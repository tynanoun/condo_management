<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaseSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lease_id');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('room_price')->nullable();
            $table->integer('water_price')->nullable();
            $table->integer('electric_price')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('lease_settings');
    }
}
