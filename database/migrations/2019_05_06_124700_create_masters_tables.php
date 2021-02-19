<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMastersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',25);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('project_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',25);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('role_has_skills', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('skill_id');
            $table->softDeletes();
            $table->timestamps();

            $table->primary(['role_id', 'skill_id']);
            $table->foreign('role_id')->references('id')->on('project_roles');
            $table->foreign('skill_id')->references('id')->on('project_skills');
        });

        Schema::create('project_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',25);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('annexure_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_type_id');
            $table->enum('type', ['personal data', 'subject categories', 'special categories', 'other']);
            $table->text('content');
            $table->enum('control_type', ['checkbox', 'text', 'label']);
            $table->integer('list_order');
            $table->boolean('default_value');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('project_type_id')->references('id')->on('project_types');
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',25);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('managers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['customer', 'supplier']);
            $table->string('name',50);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('procuring_parties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',25);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sow_master', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_type_id');
            $table->string('name',100);
            $table->text('content');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('project_type_id')->references('id')->on('project_types');
        });

        Schema::create('workflows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_type_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->timestamps();

            $table->foreign('project_type_id')->references('id')->on('project_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_roles');
        Schema::dropIfExists('project_skills');
        Schema::dropIfExists('project_types');
        Schema::dropIfExists('annexure_attributes');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('managers');
        Schema::dropIfExists('procuring_parties');
        Schema::dropIfExists('sow_master');
    }
}
