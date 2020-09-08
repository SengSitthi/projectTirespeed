<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typespares', function (Blueprint $table) {
            $table->increments('typesparesid');
            $table->string('typesparename', 100);
            $table->integer('typeserviceid')->unsigned();
            $table->foreign('typeserviceid')->references('typeserviceid')->on('typeservice')->onDelete('cascade');
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
        Schema::dropIfExists('typespares');
    }
}
