<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterToRegistrationSupportDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration_support_detail', function (Blueprint $table) {
            $table->decimal('money', 12, 2)->nullable()->change();
            $table->unsignedBigInteger('goods_id')->nullable()->change();
            $table->unsignedBigInteger('qty')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration_support_detail', function (Blueprint $table) {
            //
        });
    }
}
