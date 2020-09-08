<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair', function (Blueprint $table) {
            $table->string('cusid', 6);
            $table->foreign('cusid')->references('cusid')->on('customers')->onDelete('cascade');
            $table->string('carid', 5);
            $table->foreign('carid')->references('carid')->on('cars')->onDelete('cascade');
            $table->string('list');
            $table->date('datelist');
            $table->integer('status');
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
        Schema::dropIfExists('repair');
    }
}
