<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('priority');
            $table->string('client')->nullable();
            $table->string('direction')->nullable();
            $table->string('method')->nullable();
            $table->string('puspose')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->bigInteger('assignee')->unsigned();
            $table->string('for_all')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('company')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('assignee')->references('id')->on('users')->onUpdate('no action')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
