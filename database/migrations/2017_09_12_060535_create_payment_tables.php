<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usage_id');
            $table->integer('paid_electric')->nullable();
            $table->integer('paid_water')->nullable();
            $table->integer('paid_room')->nullable();
            $table->boolean('is_electric_paid')->default(false);
            $table->boolean('is_water_paid')->default(false);
            $table->boolean('is_room_paid')->default(false);
            $table->timestamp('room_paid_date')->nullable();
            $table->timestamp('water_paid_date')->nullable();
            $table->timestamp('electric_paid_date')->nullable();
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
