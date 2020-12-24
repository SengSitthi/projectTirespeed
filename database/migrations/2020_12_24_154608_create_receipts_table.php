<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
          $table->string('receiptid', 10);
            $table->primary('receiptid');
            $table->string('invoiceid', 10);
            $table->foreign('invoiceid')->references('invoiceid')->on('invoice');
            $table->date('receipt_date');
            $table->string('receipt_from', 100);
            $table->date('invoice_date');
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
        Schema::dropIfExists('receipts');
    }
}
