<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_period', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id');
            $table->char('period_id', 6);
            $table->text('description')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment('0: pending | 1: accepted | 2: canceled');
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('families');
            $table->foreign('period_id')->references('id')->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_period');
    }
}
