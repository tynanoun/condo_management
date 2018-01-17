<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('building_name')->nullable();
            $table->string('location')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('room_capacity')->nullable();
            $table->string('property_manager')->nullable();
            $table->string('office_email')->nullable();
            $table->string('office_number')->nullable();
            $table->string('invoice_comment')->nullable();
            $table->integer('created_by')->nullable();
            $table->boolean('is_active')->default(true);
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
