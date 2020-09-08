<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivedetail', function (Blueprint $table) {
            $table->bigIncrements('receivedetailid');
            $table->string('receiveid', 12);
            $table->foreign('receiveid')->references('receiveid')->on('receive')->onDelete('cascade');
            $table->string('sparesid', 15);
            $table->foreign('sparesid')->references('sparesid')->on('spares');
            $table->string('sparesname', 100);
            $table->integer('brandspareid')->unsigned();
            $table->foreign('brandspareid')->references('brandspareid')->on('brandspares');
            $table->string('model', 50);
            $table->string('madeyear', 10);
            $table->integer('receiveqty');
            $table->integer('price');
            $table->integer('unitid')->unsigned();
            $table->foreign('unitid')->references('unitid')->on('unitspare');
            $table->integer('total');
            $table->text('remark');
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
        Schema::dropIfExists('receivedetail');
    }
}
