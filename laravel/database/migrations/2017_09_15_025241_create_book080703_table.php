<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBook080703Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book080703', function (Blueprint $table) {
            $table->increments('BookId');
            $table->timestamps();
            $table->string('BookName',100);
            $table->string('BookAuthor',100);
            $table->string('BookPubDate',100);
            $table->string('BookImage',500);
            $table->string('BookPublisher',100);
            $table->string('BookIsbn13',20)->unique();
            $table->double('BookPrice');
            $table->integer('BookPages');
            $table->string('BookAltUrl',100);
            $table->string('BookCourse',100);
            $table->string('BookAward',100);
            $table->string('BookByOwn',100);
            $table->string('BookWithSun',100);
            $table->string('BookFromAbroad',100);
            $table->integer('BookForStu')->default(0);
            $table->integer('BookForTea')->default(0);
            $table->string('BookToClass',100);
            $table->string('Year',20);
            $table->string('Semester',20);
            $table->integer('Amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book080703');
    }
}
