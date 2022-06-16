<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyHandoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_handovers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id');
            $table->char('period_id', 6);
            $table->unsignedBigInteger('goods_id')->nullable();
            $table->unsignedInteger('qty')->nullable();
            $table->decimal('money', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('family_id')->references('id')->on('families');
            $table->foreign('goods_id')->references('id')->on('goods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_handovers');
    }
}
