<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivecarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivecars', function (Blueprint $table) {
            $table->string('rcid', 10);
            $table->primary('rcid');
            $table->string('cusid', 6);
            $table->foreign('cusid')->references('cusid')->on('customers');
            $table->string('carid', 5);
            $table->foreign('carid')->references('carid')->on('cars');
            $table->string('appoint_no', 15);
            $table->date('date_receive');
            $table->time('time_receive');
            $table->integer('instance');
            $table->string('gear', 5);
            $table->string('type_running', 5);
            $table->string('bodyoil', 5);
            $table->string('type_car', 30);
            $table->string('front_tank', 50);
            $table->string('behind_tank', 50);
            $table->string('car_mirror', 50);
            $table->string('wiper', 50);
            $table->string('insidecar', 50);
            $table->string('light', 50);
            $table->string('marchineroom', 50);
            $table->string('type_battery', 10);
            $table->string('accessory', 50);
            $table->string('kit', 50);
            $table->date('date_checked');
            $table->time('time_checked');
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
        Schema::dropIfExists('receivecars');
    }
}
