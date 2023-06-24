<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->integer('special_id');
            $table->integer('vendor_id');
            $table->integer('doctor_id');
            //$table->string('uname');
            $table->string('fname');
            $table->string('lname');
            $table->integer('price');
            $table->string('city');


            $table->text('locations');
            $table->text('about');
            $table->string('doctor_themble_photo');
            $table->integer('phone_number');
            $table->string('gender');
            $table->string('date_of_birth');
            $table->string('hospital_name');
            $table->string('hospital_address');
            $table->string('degree');
            $table->string('college');
            $table->integer('year_of_completion');
            $table->string('dwards');
            $table->integer('year');
            $table->string('registrations');
            $table->integer('year_of_registrations');
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
        Schema::dropIfExists('doctors');
    }
};
