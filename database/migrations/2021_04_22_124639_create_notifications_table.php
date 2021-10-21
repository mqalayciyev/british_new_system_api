<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company')->unsigned();
            $table->bigInteger('user')->unsigned();
            $table->bigInteger('from')->unsigned();
            $table->string('type')->nullable();
            $table->string('url')->nullable();
            $table->string('content')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('user')->references('id')->on('users')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('from')->references('id')->on('users')->onUpdate('no action')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
