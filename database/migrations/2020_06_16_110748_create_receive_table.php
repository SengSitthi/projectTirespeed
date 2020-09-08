<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive', function (Blueprint $table) {
            $table->string('receiveid', 12);
            $table->primary('receiveid');
            $table->string('userreceive', 50);
            $table->date('receivedate');
            $table->string('invoicenum')->nullable();
            $table->string('orderid', 12);
            $table->foreign('orderid')->references('orderid')->on('order')->onDelete('cascade');
            $table->string('sendername', 50);
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
        Schema::dropIfExists('receive');
    }
}
