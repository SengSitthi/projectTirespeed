<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw', function (Blueprint $table) {
            $table->string('withdrawid', 15);
            $table->primary('withdrawid');
            $table->string('userwithdraw', 50);
            $table->string('userrequest', 50);
            $table->date('withdrawdate');
            $table->string('cusid', 6);
            $table->foreign('cusid')->references('cusid')->on('customers');
            $table->string('carid', 5);
            $table->foreign('carid')->references('carid')->on('cars');
            $table->string('receivecartitle', 20);
            $table->string('receivecarfile', 100);
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
        Schema::dropIfExists('withdraw');
    }
}
