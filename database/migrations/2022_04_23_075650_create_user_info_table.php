<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number', 10)->nullable();
            $table->string('dob')->nullable();
            $table->boolean('gender')->nullable()->comment('0: female | 1: male');
            $table->string('description')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_info');
    }
}
