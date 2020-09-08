<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawdetail', function (Blueprint $table) {
            $table->bigIncrements('withdrawdetailid');
            $table->string('withdrawid', 15);
            $table->foreign('withdrawid')->references('withdrawid')->on('withdraw')->onDelete('cascade');
            $table->string('sparesid', 15);
            $table->foreign('sparesid')->references('sparesid')->on('spares');
            $table->string('sparesname', 100);
            $table->integer('brandspareid')->unsigned();
            $table->foreign('brandspareid')->references('brandspareid')->on('brandspares');
            $table->string('model', 50);
            $table->string('madeyear', 10);
            $table->integer('withdrawqty');
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
        Schema::dropIfExists('withdrawdetail');
    }
}
