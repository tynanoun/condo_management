<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('usages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('electric_old')->nullable();
            $table->integer('electric_new')->nullable();
            $table->integer('water_old')->nullable();
            $table->integer('water_new')->nullable();
            $table->string('paid_date')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_invoiced')->default(false);
            $table->boolean('is_downloaded')->default(false);
            $table->integer('room_id');
            $table->integer('price_setting_id')->nullable();
            $table->rememberToken();
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
        //
    }
}
