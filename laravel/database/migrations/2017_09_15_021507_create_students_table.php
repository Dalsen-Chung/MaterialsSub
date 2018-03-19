<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('StuID');
            $table->timestamps();
            $table->string('StuName',50);
            $table->string('StuAccount',500);
            $table->string('StuPassword',500);
            $table->string('StuDepartment',50);
            $table->string('StuPeriod',50);
            $table->string('StuMajorCode',50);
            $table->string('StuClass',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
