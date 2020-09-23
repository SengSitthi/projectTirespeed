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
            $table->string('rcsid', 15);
            $table->primary('rcsid');
            $table->string('cusid', 6);
            $table->foreign('cusid')->references('cusid')->on('customers');
            $table->string('carid', 5);
            $table->foreign('carid')->references('carid')->on('cars');
            $table->date('date_receive');
            $table->time('time_receive');
            $table->integer('meter');
            $table->string('type_car', 30);
            $table->string('gear', 30);
            $table->string('leveloil', 5);
            // $table->integer('status')->nullable(); // 1:not confirm, 2:confirm
            // $table->string('filescan')->nullable();  
            $table->string('front', 15);
            $table->string('front_remark')->nullable();
            $table->string('left', 15);
            $table->string('left_remark')->nullable();
            $table->string('right', 15);
            $table->string('right_remark')->nullable();
            $table->string('back', 15);
            $table->string('back_remark')->nullable();
            $table->string('wheels', 15);
            $table->string('wheels_remark')->nullable();
            $table->string('seats', 15);
            $table->string('seats_remark')->nullable();
            $table->string('doors', 20);
            $table->string('doors_remark')->nullable();
            $table->string('mirror', 15);
            $table->string('mirror_remark')->nullable();
            $table->string('sound', 15);
            $table->string('sound_remark')->nullable();
            $table->string('meter_display', 15);
            $table->string('meterdis_remark')->nullable();
            $table->string('accessories', 15);
            $table->string('accessories_remark')->nullable();
            $table->string('valuables', 15);
            $table->string('valuables_remark')->nullable();
            $table->string('check33', 15);
            $table->string('maintenance', 60);
            $table->string('maintenance_list');
            $table->string('repairs', 30);
            // $table->text('repairs_detail')->nullable();
            $table->string('tire_service', 50);
            // $table->string('tire_other', 50);
            $table->string('tire_detail')->nullable();
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
