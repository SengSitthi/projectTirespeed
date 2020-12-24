<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts_detail', function (Blueprint $table) {
          $table->bigIncrements('receipts_detailid');
          $table->string('receiptid', 10);
          $table->foreign('receiptid')->references('receiptid')->on('receipts')->onDelete('cascade');
          $table->string('rpnoid', 10);
          $table->integer('qty');
          $table->integer('price');
          $table->integer('total');
          $table->integer('discount')->nullable();
          $table->string('wageid', 10);
          $table->foreign('wageid')->references('wageid')->on('wages');
          $table->string('remark')->nullable();
          $table->string('status')->nullable();
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
        Schema::dropIfExists('receipts_detail');
    }
}
