<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->unsignedTinyInteger('person_qty');
            $table->string('holdhouse_id');
            $table->unsignedSmallInteger('ward_id');
            $table->timestamps();

            $table->foreign('ward_id')->references('id')->on('wards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families');
    }
}
