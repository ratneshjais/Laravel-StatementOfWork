<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSowTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sow', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sow_code',20)->comment('SOW IDENTIFIER')->nullable();
            $table->string('supp_ref',25)->comment('SUPPLIER Reference  (SOW ID)')->nullable();
            $table->string('cust_ref',25)->comment('CUSTOMER Reference')->nullable();
            $table->integer('procuring_party_id')->comment('Procuring Party')->nullable()->nullable();
            $table->string('project_name',100)->comment('Project Name')->nullable();
            $table->integer('project_type_id')->comment('Project Type')->nullable();
            $table->text('project_desc')->comment('Project Description')->nullable();
            $table->text('act_scope_work')->comment('Activities/Scope of work')->nullable();
            $table->text('skills_tech_abilities')->comment('Team Composition')->nullable();
            $table->text('infra_cust')->comment('Infrastructure from Customer')->nullable();
            $table->text('infra_supp')->comment('Infrastructure from Supplier')->nullable();
            $table->integer('location_id')->comment('Location')->nullable();
            $table->text('work_days')->comment('Work Days/Work Hours/Work Holidays')->nullable();
            $table->date('start_date')->comment('Dates')->nullable();
            $table->date('end_date')->comment('Dates')->nullable();
            $table->text('work_allocation')->comment('Work Allocation')->nullable();
            $table->text('progress_reporting')->comment('Progress Reporting')->nullable();
            $table->text('acceptance_criteria')->comment('Acceptance Criteria or Fulfilment of SoW')->nullable();
            $table->text('slas_agreed')->comment('SLAs Agreed')->nullable();
            $table->integer('cust_manager_id')->comment('Line Managers')->nullable();
            $table->integer('supp_manager_id')->comment('Line Managers')->nullable();
            $table->text('change_control')->comment('ChangeControl')->nullable();
            $table->text('risk_mitigation_plans')->comment('Risks & MitigationPlans')->nullable();
            $table->text('extension')->comment('Extension')->nullable();
            $table->text('cancellation')->comment('Cancellation / Delay / Early Termination')->nullable();
            $table->text('applicability_deliverables')->comment('Applicability of Escrow for the deliverables')->nullable();
            $table->float('price',10,2)->comment('Price (in GBP)')->nullable();
            $table->text('overtime_working')->comment('Overtime Working')->nullable();
            $table->text('payments')->comment('Payments')->nullable();
            $table->text('out_pocket_travel_exp')->comment('Out of Pocket and Travel Expenses')->nullable();
            $table->text('trans_back_arr')->comment('Transition Back Arrangements')->nullable();
            $table->text('data_protection')->comment('Data Protection')->nullable();
            $table->date('agree_date')->comment('Dates')->nullable();
            $table->string('annex_personal_other',500)->nullable();
            $table->string('authorised_processors',500)->nullable();
            $table->string('amendment_code',20)->comment('AMENDMENT IDENTIFIER')->nullable();
            $table->date('effective_from')->nullable();
            $table->date('dated')->nullable();
            $table->string('amendment_for',500)->nullable();
            $table->date('original_end_date')->nullable();
            $table->date('revised_end_date')->nullable();
            $table->float('rate',10,2)->comment('rate (in GBP)')->nullable();
            $table->float('rate_vat',10,2)->comment('rate (in VAT)')->nullable();
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('reviewer_id')->nullable();
            $table->unsignedBigInteger('approver_id')->nullable();
            $table->text('reviewer_comment')->nullable();
            $table->text('approver_comment')->nullable();
            $table->enum('status',['draft','sent_to_reviewer','sent_to_approver','rejected_by_reviewer','rejected_by_approver','approved_by_approver','deleted']);
            $table->enum('type',['sow','amendment']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users');
            
        });

        Schema::create('annexure_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('sow_id');
            $table->unsignedInteger('attribute_id');
            $table->string('value');
            //$table->softDeletes();
            
            $table->timestamps();

           $table->unique(array('sow_id', 'attribute_id'));

           $table->foreign('sow_id')->references('id')->on('sow');
           $table->foreign('attribute_id')->references('id')->on('annexure_attributes');

        });

        Schema::create('sow_team_compositions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sow_id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('skill_id');
            $table->integer('qty');
            $table->timestamp('start_date')->comment('Dates')->nullable();
            $table->timestamp('end_date')->comment('Dates')->nullable();
            $table->softDeletes();
            $table->timestamps();

           $table->foreign('sow_id')->references('id')->on('sow');
           $table->foreign('role_id')->references('id')->on('project_roles');
           $table->foreign('skill_id')->references('id')->on('project_skills'); 

        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sow_id');
            $table->text('from_status');
            $table->text('to_status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sow_id')->references('id')->on('sow');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('sow');
       Schema::dropIfExists('annexure_values');
       Schema::dropIfExists('sow_team_compositions');
       Schema::dropIfExists('transactions');
       Schema::table("annexure_values", function ($table) {
        $table->dropSoftDeletes();
       });
    }
}
