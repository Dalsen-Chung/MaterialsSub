<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu', function (Blueprint $table) {
            $table->increments('EduMId');
            $table->timestamps();
            $table->string('EduMName',50);
            $table->string('EduMAccount',500);
            $table->string('EduMPassword',500);
            $table->string('EduMDepartment',50);
            $table->string('EduMPosition',50);
            $table->string('EduMPhone',50);
            $table->string('EduMEmail',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edu');
    }
}
