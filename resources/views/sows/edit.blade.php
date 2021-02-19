@extends('layouts.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-plus text-success">
                    </i>
                </div>
                <div>New project
                    <div class="page-title-subheading">
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a class="btn btn-primary" href="{{ route('sows.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)

    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
           @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
           @endforeach
        </ul>
    </div>
    @endif

    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">New project</h5>
            {!! Form::model($sow, ['method' => 'PATCH','route' => ['sows.update', $sow->id]]) !!}
                <div class="position-relative row form-group"><label for="project_name" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-10">
                        {!! Form::text('project_name', null, array('placeholder' => 'Project Name','class' => 'form-control', 'required'=>'')) !!}
                    </div>
                </div>
                <div class="position-relative row form-group"><label for="project_type_id" class="col-sm-2 col-form-label">Project Type</label>
                    <div class="col-sm-10">
                        {!! Form::select('project_type_id', $projectTypes,$sow->project_type_id, array('class' => 'form-control', 'required'=>'')) !!}
                    </div>
                </div>
                <div class="position-relative row form-group"><label for="procuringParties" class="col-sm-2 col-form-label">Procuring Party</label>
                    <div class="col-sm-10">
                        {!! Form::select('procuring_party_id', $procuringParties,$sow->procuring_party_id, array('class' => 'form-control', 'required'=>'')) !!}
                    </div>
                </div>
                
                <div class="position-relative row form-group"><label for="project_desc" class="col-sm-2 col-form-label">Project Description</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('project_desc', null, array('placeholder' => 'Project Description','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="act_scope_work" class="col-sm-2 col-form-label">Activities/Scope of work</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('act_scope_work', null, array('placeholder' => 'Activities/Scope of work','class' => 'form-control texteditor','rows' => 6)) !!}
                    </div>
                </div>
                
                <div class="position-relative row form-group"><label for="team_composition" class="col-sm-2 col-form-label">Team Composition</label>
                    <div class="col-sm-10">
                        <table id="team_composition_table"></table>
                    </div>
                </div>
                
                <div class="position-relative row form-group"><label for="skills_tech_abilities" class="col-sm-2 col-form-label">Skills and Technical Abilities</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('skills_tech_abilities', null, array('placeholder' => 'Skills and Technical Abilities','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="infra_cust" class="col-sm-2 col-form-label">Infrastructure from Customer</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('infra_cust', null, array('placeholder' => 'Infrastructure from Customer','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="infra_supp" class="col-sm-2 col-form-label">Infrastructure from Supplier</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('infra_supp', null, array('placeholder' => 'Infrastructure from Supplier','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>
                
                <div class="position-relative row form-group"><label for="location_id" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                        {!! Form::select('location_id', $locations,[], array('class' => 'form-control', 'required'=>'')) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="work_days" class="col-sm-2 col-form-label">Work Days/Work Hours/Work Holidays</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('work_days', null, array('placeholder' => 'Work Days/Work Hours/Work Holidays','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>
                
                <div class="position-relative row form-group"><label for="start_date" class="col-sm-2 col-form-label">Dates</label>
                    <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-3">
                        {!! Form::text('start_date', null, array('class' => 'form-control', 'readonly' => 'true', 'id' => 'start_date')) !!}
                    </div>
                    
                    <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-3">
                        {!! Form::text('end_date', null, array('class' => 'form-control', 'readonly' => 'true', 'id' => 'end_date')) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="work_allocation" class="col-sm-2 col-form-label">Work Allocation</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('work_allocation', null, array('placeholder' => 'Work Allocation','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="progress_reporting" class="col-sm-2 col-form-label">Progress Reporting</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('progress_reporting', null, array('placeholder' => 'Progress Reporting','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="acceptance_criteria" class="col-sm-2 col-form-label">Acceptance Criteria or Fulfilment of SoW*</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('acceptance_criteria', null, array('placeholder' => 'Acceptance Criteria or Fulfilment of SoW','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>


                <div class="position-relative row form-group"><label for="slas_agreed" class="col-sm-2 col-form-label">SLAs Agreed</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('slas_agreed', null, array('placeholder' => 'SLAs Agreed','class' => 'form-control texteditor',  'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label  class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <label>Line Managers / Reporting To</label>
                    </div>
                </div>
                <div class="position-relative row form-group"><label for="cust_manager_id" class="col-sm-2 col-form-label">CUSTOMER Manager</label>
                    <div class="col-sm-10">
                        {!! Form::select('cust_manager_id', $customerManagers,[], array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="supp_manager_id" class="col-sm-2 col-form-label">SUPPLIER
Delivery Manager</label>
                    <div class="col-sm-10">
                        {!! Form::select('supp_manager_id', $supplierManagers,[], array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="change_control" class="col-sm-2 col-form-label">Change Control
(Applicable for Fixed Price)</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('change_control', null, array('placeholder' => 'Change Control(Applicable for Fixed Price)
','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="risk_mitigation_plans" class="col-sm-2 col-form-label">Risks & Mitigation Plans(Applicable for Fixed Price)</label>
                    <div class="col-sm-10">
                        {!! Form::text('risk_mitigation_plans', null, array('placeholder' => 'Risks & Mitigation Plans','class' => 'form-control', 'rows' => 6,'readonly'=>'')) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="extension" class="col-sm-2 col-form-label">Extension 
(Applicable for T & M & FR)</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('extension', null, array('placeholder' => 'Extension 
(Applicable for T & M & FR)','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="cancellation" class="col-sm-2 col-form-label">Cancellation / Delay / Early Termination</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('cancellation', null, array('placeholder' => 'Cancellation / Delay / Early Termination','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="applicability_deliverables" class="col-sm-2 col-form-label">Applicability of Escrow for the deliverables</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('applicability_deliverables', null, array('placeholder' => 'Applicability of Escrow for the deliverables','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="price" class="col-sm-2 col-form-label">Price (in GBP) – excluding VAT</label>
                    <div class="col-sm-10">
                        {!! Form::text('price', null, array('placeholder' => 'Price (in GBP) – excluding VAT','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="overtime_working" class="col-sm-2 col-form-label">Overtime Working
 (Applicable only for T & M/FR)</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('overtime_working', null, array('placeholder' => 'Overtime Working (Applicable only for T & M/FR)','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="payments" class="col-sm-2 col-form-label">Payments</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('payments', null, array('placeholder' => 'Payments','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="out_pocket_travel_exp" class="col-sm-2 col-form-label">Out of Pocket and Travel Expenses</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('out_pocket_travel_exp', null, array('placeholder' => 'Out of Pocket and Travel Expenses','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="trans_back_arr" class="col-sm-2 col-form-label">Transition Back Arrangements</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('trans_back_arr', null, array('placeholder' => 'Transition Back Arrangements','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="data_protection" class="col-sm-2 col-form-label">Data Protection</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('data_protection', null, array('placeholder' => 'Data Protection','class' => 'form-control texteditor', 'rows' => 6)) !!}
                    </div>
                </div>

               

                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2">
                        <button class="btn btn-secondary">Next</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
 
@endsection