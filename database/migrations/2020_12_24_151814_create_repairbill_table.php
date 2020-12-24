<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairbillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairbill', function (Blueprint $table) {
          $table->string('rpbid', 10);
          $table->primary('rpbid');
          $table->string('rcsid', 15);
          $table->foreign('rcsid')->references('rcsid')->on('receivecars');
          $table->date('rpbdate');
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
        Schema::dropIfExists('repairbill');
    }
}
