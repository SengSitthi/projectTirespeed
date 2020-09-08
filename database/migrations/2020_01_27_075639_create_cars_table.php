<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->string('carid', 5);
            $table->primary('carid');
            $table->string('license', 11);
            // $table->string('province', 25);
            $table->integer('brandid')->unsigned();
            $table->foreign('brandid')->references('brandid')->on('brands');
            $table->string('model', 25);
            $table->integer('madeyear');
            $table->string('color', 20);
            $table->integer('distance');
            $table->string('motor');
            $table->string('cusid', 6);
            $table->foreign('cusid')->references('cusid')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('cars');
    }
}
