<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('quotations_detail', function (Blueprint $table) {
        $table->bigIncrements('qtdetailid');
        $table->string('qtid', 15);
        $table->foreign('qtid')->references('qtid')->on('quotations')->onDelete('cascade');
        $table->string('rpnoid', 10);
        $table->foreign('rpnoid')->references('rpnoid')->on('repairsno');
        $table->integer('qty');
        $table->integer('price');
        $table->string('wageid', 10);
        $table->foreign('wageid')->references('wageid')->on('wages');
        $table->integer('total');
        $table->string('status');
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
        Schema::dropIfExists('quotations_detail');
    }
}
