<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company')->unsigned();
            $table->bigInteger('exam')->unsigned();
            $table->bigInteger('student')->unsigned();
			$table->bigInteger('test')->unsigned();
            $table->bigInteger('type')->unsigned()->nullable();
            $table->bigInteger('question')->unsigned();
            $table->bigInteger('answer')->unsigned();
            $table->string('result');
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('exam')->references('id')->on('exams')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('type')->references('id')->on('exam_types')->onUpdate('no action')->nullOnDelete();
            $table->foreign('student')->references('id')->on('users')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('test')->references('id')->on('tests')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('question')->references('id')->on('questions')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('answer')->references('id')->on('question_answers')->onUpdate('no action')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_results');
    }
}
