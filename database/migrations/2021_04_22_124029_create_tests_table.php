<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company')->unsigned();
            $table->bigInteger('assignee')->unsigned()->nullable();
            $table->string('name');
            $table->bigInteger('lesson')->unsigned()->nullable();
            $table->bigInteger('exam')->unsigned()->nullable();
            $table->bigInteger('level')->unsigned()->nullable();
            $table->bigInteger('age_category')->unsigned()->nullable();
            $table->text('note')->nullable();
            $table->string('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('assignee')->references('id')->on('users')->onUpdate('no action')->nullOnDelete();
            $table->foreign('lesson')->references('id')->on('lessons')->onUpdate('no action')->nullOnDelete();
            $table->foreign('exam')->references('id')->on('exams')->onUpdate('no action')->nullOnDelete();
            $table->foreign('level')->references('id')->on('levels')->onUpdate('no action')->nullOnDelete();
            $table->foreign('age_category')->references('id')->on('age_categories')->onUpdate('no action')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
