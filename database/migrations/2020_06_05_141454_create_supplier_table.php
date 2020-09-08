<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->string('supplierid', 6);
            $table->primary('supplierid');
            $table->string('suppliername', 100);
            $table->integer('suppliertax');
            $table->string('village', 50);
            $table->integer('disid')->unsigned();
            $table->foreign('disid')->references('disid')->on('districts');
            $table->integer('proid')->unsigned();
            $table->foreign('proid')->references('proid')->on('provinces');
            $table->string('mobile', 15);
            $table->string('phone', 15);
            $table->string('fax', 25);
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
        Schema::dropIfExists('supplier');
    }
}
