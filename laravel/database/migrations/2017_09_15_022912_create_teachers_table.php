<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->increments('Teaid');
            $table->timestamps();
            $table->string('TeaName',50);
            $table->string('TeaAccount',500);
            $table->string('TeaPassword',500);
            $table->string('TeaDepartment',50);
            $table->string('TeaEducation',50);
            $table->string('TeaPhone',50);
            $table->string('TeaEmail',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher');
    }
}
