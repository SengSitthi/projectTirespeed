<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
          $table->string('qtid', 15);
          $table->primary('qtid');
          $table->string('rpbid', 10);
          $table->foreign('rpbid')->references('rpbid')->on('repairbill');
          $table->string('part', 100);
          $table->date('checkin_date');
          $table->string('checkin_time');
          $table->date('checkout_date');
          $table->string('checkout_time');
          $table->date('expire_date');
          $table->integer('credit_day');
          $table->integer('instance');
          $table->string('receive_bill', 10);
          $table->date('document_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotations');
    }
}
