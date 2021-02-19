<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('project_type_id');
            $table->enum('type', ['personal data','subject categories','special categories','other']);
            $table->text('content');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });

        Schema::table('data_attributes', function (Blueprint $table) {    
            $table->foreign('project_type_id')->references('id')->on('project_types');
        });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_attributes');
    }
}
