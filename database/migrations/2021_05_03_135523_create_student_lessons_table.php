<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student')->unsigned();
            $table->bigInteger('company')->unsigned();
            $table->bigInteger('lesson')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('student')->references('id')->on('users')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('lesson')->references('id')->on('lessons')->onUpdate('no action')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_lessons');
    }
}
