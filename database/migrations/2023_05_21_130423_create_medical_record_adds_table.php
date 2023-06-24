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
        Schema::create('medical_record_adds', function (Blueprint $table) {
            $table->id();
            $table->integer('p_id');
            $table->string('title');
            $table->string('patient_relative');
            $table->string('hospital');
            // $table->text('description');
            $table->string('user_prespation');
            $table->string('services');
            $table->string('tratment_date');
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
        Schema::dropIfExists('medical_record_adds');
    }
};
