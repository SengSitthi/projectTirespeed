<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->bigIncrements('invoice_detailid');
            $table->string('invoiceid', 15);
            $table->foreign('invoiceid')->references('invoiceid')->on('invoice')->onDelete('cascade');
            $table->string('rpnoid', 10);
            $table->foreign('rpnoid')->references('rpnoid')->on('repairsno');
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
        Schema::dropIfExists('invoice_detail');
    }
}
