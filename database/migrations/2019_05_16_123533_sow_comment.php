<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SowComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sow_comment', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('sow_id');
            $table->integer('user_id');
            $table->text('comments');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sow_attribute_comments', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('sow_id');
            $table->integer('user_id');
            $table->string('attribute',50);
            $table->text('comments');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sow_comment');
        Schema::dropIfExists('sow_attribute_comments');
    }
}
