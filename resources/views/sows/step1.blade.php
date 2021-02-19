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
                    {{ Breadcrumbs::render('sowEdit', $filter, $sow ,  "1") }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sows.progressbar')

    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">New project</h5>
            {!! Form::model($sow, ['method' => 'PATCH','route' => ['sows.update', $sow->id  ],'id'=>'formstepone']) !!}
                {!! Form::hidden('step',2) !!}
                {!! Form::hidden('filter',$filter) !!}
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="project_name" class="col-sm-2 col-form-label control-label">Project Name</label>
                    <div class="col-sm-10">
                        {!! Form::text('project_name', null, array('placeholder' => 'Project Name','class' => 'form-control', 'required'=>'','maxlength'=>'100')) !!}
                        {!! $errors->first('project_name', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["project_name"]) ? $attributeComments["project_name"] : array()])
                    @endcomponent
                </div>
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="project_type_id" class="col-sm-2 col-form-label control-label">Project Type</label>
                    <div class="col-sm-10">
                        {!! Form::select('project_type_id', $projectTypes,$sow->project_type_id, array('class' => 'form-control', 'required'=>'', 'id' => 'project_type_id' )) !!}
                        {!! $errors->first('project_type_id', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["project_type"]) ? $attributeComments["project_type"] : array()])
                    @endcomponent
                </div>
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="procuringParties" class="col-sm-2 col-form-label control-label">Procuring Party</label>
                    <div class="col-sm-10">
                        {!! Form::select('procuring_party_id', $procuringParties,$sow->procuring_party_id, array('class' => 'form-control', 'required'=>'')) !!}
                        {!! $errors->first('procuring_party_id', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["procuringParties"]) ? $attributeComments["procuringParties"] : array()])
                    @endcomponent
                </div>
                
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="project_desc" class="col-sm-2 col-form-label control-label">Project Description</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('project_desc', null, array('placeholder' => 'Project Description','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('project_desc', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["project_desc"]) ? $attributeComments["project_desc"] : array()])
                    @endcomponent
                </div>
                
                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2 ">
                        <button class="pull-right btn btn-primary" id="nextBtnStepOne" type="button" data-protypeold="{{$sow->project_type_id}}">Next</button>
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
