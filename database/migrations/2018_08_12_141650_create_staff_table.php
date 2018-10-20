<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facility_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('device_sn')->nullable();
            $table->string('device_imei')->nullable();
            $table->string('type');
            $table->boolean('status')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('facility_id')->references('id')
                  ->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
