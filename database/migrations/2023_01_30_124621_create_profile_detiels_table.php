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
        Schema::create('profile_detiels', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('date_of_birth');
            $table->string('bgroup');
            $table->string('email');
            $table->integer('phone_number');
            $table->string('city');
            $table->string('division');
            $table->string('zip')->nullable();
            $table->string('country');
            $table->string('adderss');
            $table->text('about');
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
        Schema::dropIfExists('profile_detiels');
    }
};
