<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company')->unsigned();
            $table->bigInteger('payer')->unsigned()->nullable();
            $table->bigInteger('assignee')->unsigned()->nullable();
            $table->bigInteger('office')->unsigned()->nullable();
            $table->bigInteger('lesson')->unsigned()->nullable();
            $table->tinyInteger('status')->default('0');
            $table->string('payment_value');
            $table->string('price');
            $table->string('payment_due');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('payer')->references('id')->on('users')->onUpdate('no action')->nullOnDelete();
            $table->foreign('assignee')->references('id')->on('users')->onUpdate('no action')->nullOnDelete();
            $table->foreign('office')->references('id')->on('offices')->onUpdate('no action')->nullOnDelete();
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
        Schema::dropIfExists('payments');
    }
}
