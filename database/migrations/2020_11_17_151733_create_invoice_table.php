<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('invoice', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->string('invoiceid', 10);
        $table->primary('invoiceid');
        $table->string('qtid', 15);
        $table->foreign('qtid')->references('qtid')->on('quotations');
        $table->integer('cpid')->unsigned();
        $table->foreign('cpid')->references('cpid')->on('company');
        $table->date('invoice_date');
        $table->integer('discount');
        $table->date('expire_date');
        $table->integer('credit');
        $table->string('status', 50);
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
        Schema::dropIfExists('invoice');
    }
}
