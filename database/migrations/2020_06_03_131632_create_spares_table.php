<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spares', function (Blueprint $table) {
            $table->string('sparesid', 15);
            $table->primary('sparesid');
            $table->string('sparesname', 100);
            $table->integer('typeserviceid')->unsigned();
            $table->foreign('typeserviceid')->references('typeserviceid')->on('typeservice')->onDelete('cascade');
            $table->integer('typesparesid')->unsigned();
            $table->foreign('typesparesid')->references('typesparesid')->on('typespares')->onDelete('cascade');
            $table->integer('brandspareid')->unsigned();
            $table->foreign('brandspareid')->references('brandspareid')->on('brandspares')->onDelete('cascade');
            $table->string('model', 50);
            $table->string('madeyear', 4);
            $table->integer('sellprice');
            $table->integer('unitid')->unsigned();
            $table->foreign('unitid')->references('unitid')->on('unitspare')->onDelete('cascade');
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
        Schema::dropIfExists('spares');
    }
}
