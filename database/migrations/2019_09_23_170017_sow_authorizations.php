<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SowAuthorizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sow_authorizations', function ($table) {
            $table->increments('id');
            $table->integer('sow_id');
            $table->integer('transaction_id');
            $table->integer('role_id');
            $table->integer('user_id');
            $table->enum('status',['Approved','Rejected','Pending','Defaulted']);
            $table->timestamps();

            $table->index(array('role_id', 'transaction_id', 'user_id', 'sow_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sow_authorizations');
    }
}
