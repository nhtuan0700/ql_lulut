<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_id');
            $table->unsignedBigInteger('goods_id')->nullable();
            $table->unsignedInteger('qty')->nullable();
            $table->decimal('money', 12, 0);
            $table->timestamps();
            
            $table->foreign('support_id')->references('id')->on('supports');
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
        Schema::dropIfExists('support_detail');
    }
}
