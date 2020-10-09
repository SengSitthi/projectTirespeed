<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('wages', function (Blueprint $table) {
        $table->string('wageid', 10);
        $table->primary('wageid');
        $table->string('wagename');
        $table->integer('typeserviceid')->unsigned();
        $table->foreign('typeserviceid')->references('typeserviceid')->on('typeservice');
        $table->integer('typesparesid')->unsigned();
        $table->foreign('typesparesid')->references('typesparesid')->on('typespares');
        $table->integer('cost')->nullable();
        $table->integer('tcarid')->unsigned();
        $table->foreign('tcarid')->references('tcarid')->on('typecars');
        $table->string('guaranty')->nullable();
        $table->string('timeset')->nullable();
        $table->integer('unitrpid')->unsigned();
        $table->foreign('unitrpid')->references('unitrpid')->on('unitrepairs');
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
        Schema::dropIfExists('wages');
    }
}
