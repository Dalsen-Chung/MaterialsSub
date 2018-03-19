<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHadBookedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadbooked',function (Blueprint $table){
            $table->increments('HadId');
            $table->timestamps();
            $table->string('HadAccount');
            $table->string('HadYear');
            $table->string('HadSemester');
            $table->string('HadSubscribe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hadbooked');
    }
}
