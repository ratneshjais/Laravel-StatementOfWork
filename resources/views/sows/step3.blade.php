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
                    {{ Breadcrumbs::render('sowEdit', $filter, $sow ,  "3") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    @include('sows.progressbar')

    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">New project</h5>
            {!! Form::model($sow, ['method' => 'PATCH','route' => ['sows.update', $sow->id, 4]]) !!}
                {!! Form::hidden('step',4) !!}
                {!! Form::hidden('filter',$filter) !!}
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="progress_reporting" class="col-sm-2 col-form-label control-label">Progress Reporting</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('progress_reporting', null, array('placeholder' => 'Progress Reporting','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('progress_reporting', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["progress_reporting"]) ? $attributeComments["progress_reporting"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="acceptance_criteria" class="col-sm-2 col-form-label control-label">Acceptance Criteria / Fulfilment of SoW</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('acceptance_criteria', null, array('placeholder' => 'Acceptance Criteria or Fulfilment of SoW','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('acceptance_criteria', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["acceptance_criteria"]) ? $attributeComments["acceptance_criteria"] : array()])
                    @endcomponent
                </div>


                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="slas_agreed" class="col-sm-2 col-form-label control-label">SLAs Agreed</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('slas_agreed', null, array('placeholder' => 'SLAs Agreed','class' => 'form-control texteditor',  'rows' => 6)) !!}
                        {!! $errors->first('slas_agreed', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["slas_agreed"]) ? $attributeComments["slas_agreed"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row ">
                                    <label class="col-sm-2  col-form-label ">Line Managers / Reporting To</label>
                                    <div class="col-sm-10">
                                            <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"">
                                                    <label for="customerManager" class="col-sm-2  col-form-label ">CUSTOMER Manager</label>
                                                    <div class="col-sm-10  col-form-label   ">
                                                    {!! Form::select('cust_manager_id', $customerManagers,$sow->cust_manager_id, array('class' => 'form-control')) !!}
                                {!! $errors->first('cust_manager_id', '<p class="input_error_msg">:message</p>') !!}
                                                    </div>
                                                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["customerManager"]) ? $attributeComments["customerManager"] : array()])
                                                    @endcomponent             
                                            </div>
                                            <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"">
                                                    <label for="supplierManager" class="col-sm-2  col-form-label ">SUPPLIER Delivery Manager</label>
                                                    <div class="col-sm-10 ">
                                                    {!! Form::select('supp_manager_id', $supplierManagers,$sow->supp_manager_id, array('class' => 'form-control')) !!}
                                {!! $errors->first('supp_manager_id', '<p class="input_error_msg">:message</p>') !!}
                                                    </div>
                                                     @component('component.sowcommentview', ['comments' => @isset($attributeComments["supplierManager"]) ? $attributeComments["supplierManager"] : array()])
                                                     @endcomponent
                                            </div>               
                                     </div>                   
                </div>
                @if($sow->project_type->type == 'FP')

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="change_control" class="col-sm-2 col-form-label control-label">Change Control
(Applicable for Fixed Price)</label>
                    <div class="col-sm-10" id="change_control_text_value">
                        <label class="col-form-label">{!! $sow->change_control !!}</label>
                    </div>
                </div>

                <div class="position-relative row form-group"  id="change_control_div" style="display:none;"><label class="col-sm-2"></label>
                        <div class="col-sm-10">
                                {!! Form::textarea('change_control', null, array('placeholder' => 'Change Control(Applicable for Fixed Price)', 'class' => 'form-control', 'id'=>'change_control', 'rows' => 6,'readonly'=>'')) !!}
{!! $errors->first('change_control', '<p class="input_error_msg">:message</p>') !!}
                        </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["change_control"]) ? $attributeComments["change_control"] : array()])
                    @endcomponent                       
                </div> 

                <div class="position-relative row form-group" class="col-sm-12"><label></label>
                        <div class="col-sm-12">
                                <button class="pull-right btn btn-primary" id="add-control-change-btn" type="button">Add</button>
                        </div>
                </div> 

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="risk_mitigation_plans" class="col-sm-2 col-form-label control-label">Risks & Mitigation Plans(Applicable for Fixed Price)</label>
                    <div class="col-sm-10">
                        {!! Form::text('risk_mitigation_plans', null, array('placeholder' => 'Risks & Mitigation Plans','class' => 'form-control', 'rows' => 6,'readonly'=>'')) !!}
                        {!! $errors->first('risk_mitigation_plans', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["risk_mitigation_plans"]) ? $attributeComments["risk_mitigation_plans"] : array()])
                    @endcomponent
                </div>
                @endif    

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="extension" class="col-sm-2 col-form-label control-label">Extension 
(Applicable for T & M & FR)</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('extension', null, array('placeholder' => 'Extension 
(Applicable for T & M & FR)','class' => 'form-control texteditor', 'rows' => 6)) !!}
{!! $errors->first('extension', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["extension"]) ? $attributeComments["extension"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="cancellation" class="col-sm-2 col-form-label control-label">Cancellation / Delay / Early Termination</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('cancellation', null, array('placeholder' => 'Cancellation / Delay / Early Termination','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('cancellation', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["cancellation"]) ? $attributeComments["cancellation"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2 padding-l-0">
                        <a class="btn btn-primary" href="{{ route('sowEdit', ['filter'=>$filter, 'id' => $sow->id, 'step' => 2]) }}">Back</a>
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