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
        Schema::create('invoice__deatiels', function (Blueprint $table) {
            $table->id();
            $table->integer('invoices_id');
            $table->integer('patient_id');
            $table->integer('doctor_id');
            $table->string('appioment_date');
            $table->string('appioment_time');
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
        Schema::dropIfExists('invoice__deatiels');
    }
};
