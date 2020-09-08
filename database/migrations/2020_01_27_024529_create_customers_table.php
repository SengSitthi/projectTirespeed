<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('cusid', 6);
            $table->primary('cusid');
            $table->string('name');
            $table->string('lastname');
            // $table->date('birthday');
            $table->string('village');
            $table->integer('disid')->unsigned();
            $table->foreign('disid')->references('disid')->on('districts');
            $table->integer('proid')->unsigned();
            $table->foreign('proid')->references('proid')->on('provinces');
            $table->integer('mobile');
            $table->integer('phone');
            $table->string('occupation');
            $table->string('workaddress');
            $table->integer('tcusid')->unsigned();
            $table->foreign('tcusid')->references('tcusid')->on('typecuses');
            $table->string('status', 10);
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
        Schema::dropIfExists('customers');
    }
}
