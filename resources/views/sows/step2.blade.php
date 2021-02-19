@extends('layouts.app')


@section('content')
    
    <!-- @if (count($errors) > 0)

    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
           @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
           @endforeach
        </ul>
    </div>
    @endif -->

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-plus text-success">
                    </i>
                </div>
                <div>Statement Of Work
                    <div class="page-title-subheading">
                    {{ Breadcrumbs::render('sowEdit', $filter, $sow ,  "2") }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sows.progressbar')

    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">New project</h5>
            {!! Form::model($sow, ['method' => 'PATCH','route' => ['sows.update', $sow->id]]) !!}
                {!! Form::hidden('step',3) !!}
                {!! Form::hidden('filter',$filter) !!}
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="act_scope_work" class="col-sm-2 col-form-label control-label">Activities/Scope of work</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('act_scope_work', null, array('placeholder' => 'Activities/Scope of work','class' => 'form-control texteditor d-none','rows' => 6)) !!}
                        {!! $errors->first('act_scope_work', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["act_scope_work"]) ? $attributeComments["act_scope_work"] : array()])
                    @endcomponent
                </div>
                
                @if($sow->project_type->type != 'FP')
                    {!! Form::hidden('team_composition_rows',0) !!}
                    <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                        <label for="team_composition_table" class="col-sm-2 col-form-label control-label">Team Composition</label>
                        <div class="col-sm-10">
                            <table id="team_composition_table" data-sow-id='{{ $sow->id }}' data-state='active'></table>
                            {!! $errors->first('team_composition_rows', '<p class="input_error_msg">:message</p>') !!}
                            <p class="input_error_msg" id="error_team_composition"></p>
                        </div>
                        @component('component.sowcommentview', ['comments' => @isset($attributeComments["team_composition"]) ? $attributeComments["team_composition"] : array()])
                        @endcomponent
                    </div>
                @endif
                
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="skills_tech_abilities" class="col-sm-2 col-form-label control-label">Skills and Technical Abilities</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('skills_tech_abilities', null, array('placeholder' => 'Skills and Technical Abilities','class' => 'form-control texteditor d-none', 'rows' => 6)) !!}
                        {!! $errors->first('skills_tech_abilities', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["skills_tech_abilities"]) ? $attributeComments["skills_tech_abilities"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="infra_cust" class="col-sm-2 col-form-label control-label">Infrastructure from Customer</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('infra_cust', null, array('placeholder' => 'Infrastructure from Customer','class' => 'form-control texteditor d-none', 'rows' => 6)) !!}
                        {!! $errors->first('infra_cust', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["infra_cust"]) ? $attributeComments["infra_cust"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="infra_supp" class="col-sm-2 col-form-label control-label">Infrastructure from Supplier</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('infra_supp', null, array('placeholder' => 'Infrastructure from Supplier','class' => 'form-control texteditor d-none', 'rows' => 6)) !!}
                        {!! $errors->first('infra_supp', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["infra_supp"]) ? $attributeComments["infra_supp"] : array()])
                    @endcomponent
                </div>
                
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="location_id" class="col-sm-2 col-form-label control-label">Location</label>
                    <div class="col-sm-10">
                        {!! Form::select('location_id', $locations,$sow->location_id, array('class' => 'form-control', 'required'=>'')) !!}
                        {!! $errors->first('location_id', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["location_id"]) ? $attributeComments["location_id"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="work_days" class="col-sm-2 col-form-label control-label">Work Days/Work Hours/Work Holidays</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('work_days', null, array('placeholder' => 'Work Days/Work Hours/Work Holidays','class' => 'form-control texteditor d-none', 'rows' => 6)) !!}
                        {!! $errors->first('work_days', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["work_days"]) ? $attributeComments["work_days"] : array()])
                    @endcomponent
                </div>
                
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="start_date" class="col-sm-2 col-form-label control-label">Dates</label>
                    <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-3">
                        {!! Form::text('start_date', null, array('class' => 'form-control', 'readonly' => 'true', 'id' => 'start_date')) !!}
                        {!! $errors->first('start_date', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["start_date"]) ? $attributeComments["start_date"] : array()])
                    @endcomponent
                    
                    <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-3">
                        {!! Form::text('end_date', null, array('class' => 'form-control', 'readonly' => 'true', 'id' => 'end_date')) !!}
                        {!! $errors->first('end_date', '<p class="input_error_msg">:message</p>') !!}                    
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["end_date"]) ? $attributeComments["end_date"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="work_allocation" class="col-sm-2 col-form-label control-label">Work Allocation</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('work_allocation', null, array('placeholder' => 'Work Allocation','class' => 'form-control texteditor d-none', 'rows' => 6)) !!}
                        {!! $errors->first('work_allocation', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["work_allocation"]) ? $attributeComments["work_allocation"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2">
                       
                    </div>
                    <div class="col-sm-10 offset-sm-2 padding-l-0">
                         <a class="btn btn-primary" href="{{ route('sowEdit', ['filter'=>$filter, 'id' => $sow->id, 'step' => 1]) }}">Back</a>
                        <button class="pull-right btn btn-primary">Next</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
 
@endsection


<div id="commentModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    {!! Form::hidden('sow_id',$sow->id) !!}
                    {!! Form::hidden('user_id',Auth::user()->id) !!}
                        <div class="form-group">
                            <label for="edit-taunt">Comment</label>
                            <textarea name="post-body" id="post-body" rows="5" class="form-control"></textarea>
                        </div>
                    
                </form>
                <div class="comments-list col-sm-12 border-l-r d-none" id="comments-list"></div>              
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="commentable-comment-save">Save changes</button>
                
            </div>
        </div>
    </div>
</div>