<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_maps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company')->unsigned();
            $table->bigInteger('office')->unsigned();
            $table->bigInteger('teacher')->unsigned()->nullable();
            $table->bigInteger('lesson')->unsigned()->nullable();
            $table->bigInteger('student')->unsigned()->nullable();
            $table->string('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('office')->references('id')->on('offices')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('teacher')->references('id')->on('users')->onUpdate('no action')->nullOnDelete();
            $table->foreign('lesson')->references('id')->on('lessons')->onUpdate('no action')->nullOnDelete();
            $table->foreign('student')->references('id')->on('users')->onUpdate('no action')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendace_maps');
    }
}
