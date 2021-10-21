<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('company')->unsigned();
            $table->bigInteger('office')->unsigned();
            $table->bigInteger('level')->unsigned()->nullable();
            $table->bigInteger('hours');
            $table->bigInteger('teacher')->unsigned()->nullable();
            $table->bigInteger('lesson')->unsigned()->nullable();
            $table->integer('capacity');
            $table->bigInteger('age_category')->unsigned()->nullable();
            $table->bigInteger('type')->unsigned()->nullable();
            $table->bigInteger('price')->unsigned()->nullable();
            $table->tinyInteger('monday')->nullable();
            $table->tinyInteger('tuesday')->nullable();
            $table->tinyInteger('wednesday')->nullable();
            $table->tinyInteger('thursday')->nullable();
            $table->tinyInteger('friday')->nullable();
            $table->tinyInteger('saturday')->nullable();
            $table->tinyInteger('sunday')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('office')->references('id')->on('offices')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('teacher')->references('id')->on('users')->onUpdate('no action')->nullOnDelete();
            $table->foreign('level')->references('id')->on('levels')->onUpdate('no action')->nullOnDelete();
            $table->foreign('price')->references('id')->on('academic_hours')->onUpdate('no action')->nullOnDelete();
            $table->foreign('type')->references('id')->on('learning_types')->onUpdate('no action')->nullOnDelete();
            $table->foreign('age_category')->references('id')->on('age_categories')->onUpdate('no action')->nullOnDelete();
            $table->foreign('lesson')->references('id')->on('lessons')->onUpdate('no action')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_lessons');
    }
}
