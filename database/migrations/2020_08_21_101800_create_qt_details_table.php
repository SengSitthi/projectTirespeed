<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQtDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qt_details', function (Blueprint $table) {
            $table->bigIncrements('qtdetailid');
            $table->string('qtid', 15);
            $table->foreign('qtid')->references('qtid')->on('quotations')->onDelete('cascade');
            $table->string('sparesid', 15);
            $table->foreign('sparesid')->references('sparesid')->on('spares');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('wages');
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
        Schema::dropIfExists('qt_details');
    }
}
