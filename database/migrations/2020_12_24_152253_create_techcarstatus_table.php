<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechcarstatusTable extends Migration
{
  /**
    * Run the migrations.
    *
    * @return void
    */
  public function up()
  {
    Schema::create('techcarstatus', function (Blueprint $table) {
      $table->Increments('tcsid');
      $table->string('rpbid', 10);
      $table->foreign('rpbid')->references('rpbid')->on('repairbill')->onDelete('cascade');
      $table->date('date_in');
      $table->time('time_in');
      $table->date('date_out')->nullable();
      $table->time('time_out')->nullable();
      $table->integer('status')->unsigned(); // 1 ລົດ​ກຳ​ລັງ​ລໍ​ຖ້າ​ສ້ອມ, 2 ລົດ​ກຳ​ລັງ​ລໍ​ຖ້າ​ອະ​ໄຫຼ່, 3 ລົດ​ກຳ​ລັງ​ສ້ອມ, 4 ສ້ອມ​ສຳ​ເລັດ, 5 ສົ່ງ​ລົດ​ຄືນ​ລູກ​ຄ້າ
      $table->string('remark')->nullable();
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
    Schema::dropIfExists('techcarstatus');
  }
}
