<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupaccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supaccount', function (Blueprint $table) {
            $table->increments('supaccountid');
            $table->string('supplierid', 6)->nullable();
            $table->foreign('supplierid')->references('supplierid')->on('supplier')->onDelete('cascade');
            $table->string('bankname', 50)->nullable();
            $table->string('accountnum', 25)->nullable();
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
        Schema::dropIfExists('supaccount');
    }
}
