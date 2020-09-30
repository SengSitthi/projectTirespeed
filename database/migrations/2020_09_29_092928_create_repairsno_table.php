<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairsno', function (Blueprint $table) {
          $table->string('rpnoid', 6);
          $table->primary('rpnoid');
          // $table->integer('typesparesid')->unsigned();
          // $table->foreign('typesparesid')->references('typesparesid')->on('typespares');
          $table->string('sparesid', 15);
          $table->foreign('sparesid')->references('sparesid')->on('spares')->onDelete('cascade');
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
        Schema::dropIfExists('repairsno');
    }
}
