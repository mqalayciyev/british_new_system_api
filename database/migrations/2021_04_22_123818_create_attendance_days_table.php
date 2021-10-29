<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_days', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attendance')->unsigned();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->foreign('attendance')->references('id')->on('attendances')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_days');
    }
}
