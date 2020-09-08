<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetail', function (Blueprint $table) {
            $table->increments('orderdetialid');
            $table->string('orderid', 12);
            $table->foreign('orderid')->references('orderid')->on('order')->onDelete('cascade');
            $table->string('sparesid', 15);
            $table->foreign('sparesid')->references('sparesid')->on('spares');
            $table->string('sparesname', 150);
            $table->integer('brandspareid')->unsigned();
            $table->foreign('brandspareid')->references('brandspareid')->on('brandspares');
            $table->string('model', 50);
            $table->string('madeyear', 4);
            $table->integer('orderqty');
            // $table->integer('price');
            $table->integer('unitid')->unsigned();
            $table->foreign('unitid')->references('unitid')->on('unitspare');
            // $table->integer('total');
            $table->string('status', 50);
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
        Schema::dropIfExists('orderdetail');
    }
}
