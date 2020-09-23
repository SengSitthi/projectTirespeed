<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivecarsDetailTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('receivecars_detail', function (Blueprint $table) {
      $table->increments('rcs_detailid');
      $table->string('rcsid', 15);
      $table->foreign('rcsid')->references('rcsid')->on('receivecars')->onDelete('cascade');
      $table->string('rcs_list')->nullable();
      $table->integer('status');
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
        Schema::dropIfExists('receivecars_detail');
    }
}
