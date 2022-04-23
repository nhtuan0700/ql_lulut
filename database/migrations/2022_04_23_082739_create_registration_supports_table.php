<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('period_id');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: pending | 1: finished | 2: caneled');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('period_id')->references('id')->on('periods');
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
        Schema::dropIfExists('registration_supports');
    }
}
