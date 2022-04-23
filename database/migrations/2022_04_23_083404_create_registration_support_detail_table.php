<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationSupportDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_support_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_support_id');
            $table->unsignedBigInteger('goods_id');
            $table->string('goods_name')->nullable();
            $table->unsignedInteger('qty');
            $table->decimal('money', 12, 2);
            $table->timestamps();

            $table->foreign('registration_support_id')->references('id')->on('registration_supports');
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
        Schema::dropIfExists('registration_support_detail');
    }
}
