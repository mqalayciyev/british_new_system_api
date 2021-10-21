<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('mobile');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('office')->nullable();
            $table->string('date')->nullable();
            $table->string('gender')->nullable();
            $table->text('note')->nullable();
            $table->string('person_first_name')->nullable();
            $table->string('person_last_name')->nullable();
            $table->string('person_relationship')->nullable();
            $table->string('person_mobile')->nullable();
            $table->string('person_email')->nullable();
            $table->string('initial_date')->nullable();
            $table->string('initial_contact')->nullable();
            $table->string('purpose')->nullable();
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->bigInteger('level')->unsigned()->nullable();
            $table->bigInteger('age_category')->unsigned()->nullable();
            $table->bigInteger('learning_type')->unsigned()->nullable();
            $table->bigInteger('corparate')->unsigned()->nullable();
            $table->bigInteger('added_by')->unsigned()->nullable();
            $table->bigInteger('salary')->unsigned()->nullable();
            $table->bigInteger('permission')->unsigned()->nullable();
            $table->bigInteger('company')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('company')->references('id')->on('companies')->onUpdate('no action')->cascadeOnDelete();
            $table->foreign('corparate')->references('id')->on('corparate_clients')->onUpdate('no action')->nullOnDelete();
            $table->foreign('permission')->references('id')->on('permissions')->onUpdate('no action')->nullOnDelete();
            $table->foreign('level')->references('id')->on('levels')->onUpdate('no action')->nullOnDelete();
            $table->foreign('age_category')->references('id')->on('age_categories')->onUpdate('no action')->nullOnDelete();
            $table->foreign('learning_type')->references('id')->on('learning_types')->onUpdate('no action')->nullOnDelete();
            $table->foreign('salary')->references('id')->on('teacher_payments')->onUpdate('no action')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
