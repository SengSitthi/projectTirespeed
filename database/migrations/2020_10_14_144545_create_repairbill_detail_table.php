<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairbillDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairbill_detail', function (Blueprint $table) {
            $table->bigIncrements('rpbdtid');
            $table->string('rpbid');
            $table->foreign('rpbid')->references('rpbid')->on('repairbill')->onDelete('cascade');
            $table->string('rpnoid', 10);
            $table->foreign('rpnoid')->references('rpnoid')->on('repairsno');
            $table->integer('useqty');
            $table->string('wageid', 10);
            $table->foreign('wageid')->references('wageid')->on('wages');
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
        Schema::dropIfExists('repairbill_detail');
    }
}
