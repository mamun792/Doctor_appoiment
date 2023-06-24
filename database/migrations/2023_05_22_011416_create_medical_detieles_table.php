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
        Schema::create('medical_detieles', function (Blueprint $table) {
            $table->id();
            $table->integer('p_id');
            $table->integer('bmi');
            $table->integer('heart');
            $table->string('Weight');
            $table->integer('Fbc');
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
        Schema::dropIfExists('medical_detieles');
    }
};
