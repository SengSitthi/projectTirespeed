<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->string('empid', 6);
            $table->primary('empid');
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->date('birthday');
            $table->string('village');
            $table->integer('disid')->unsigned();
            $table->foreign('disid')->references('disid')->on('districts');
            $table->integer('proid')->unsigned();
            $table->foreign('proid')->references('proid')->on('provinces');
            $table->string('mobile', 15);
            $table->string('email', 50);
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
        Schema::dropIfExists('employees');
    }
}
