<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_levels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exam')->unsigned();
            $table->bigInteger('level')->unsigned();
            $table->bigInteger('company')->unsigned();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('exam')->references('id')->on('exams')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('level')->references('id')->on('levels')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_levels');
    }
}
