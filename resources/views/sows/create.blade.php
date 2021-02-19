@extends('layouts.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-plus text-success">
                    </i>
                </div>
                <div>Statement Of Work
                    <div class="page-title-subheading">
                    {{ Breadcrumbs::render('sowCreate') }}

                    </div>
                </div>
            </div>
              
             </div>
    </div>

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

    <div class="main-card mb-3 card">
        <div class="card-body">
        <div id="header_desc"><?php print_r( $headerDesc[0]);?></div>
            {!! Form::open(array('route' => 'sows.store','method'=>'POST')) !!}
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="project_name" class="col-sm-2 col-form-label control-label">Project Name</label>
                    <div class="col-sm-10">
                        {!! Form::text('project_name', null, array('placeholder' => 'Project Name','class' => 'form-control', 'required'=>'','maxlength'=>'100')) !!}
                        {!! $errors->first('project_name', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="project_type_id" class="col-sm-2 col-form-label control-label">Project Type</label>
                    <div class="col-sm-10">
                        {!! Form::select('project_type_id', $projectTypes,[1], array('class' => 'form-control', 'required'=>'', 'id' => 'project_type_id' )) !!}
                        {!! $errors->first('project_type_id', '<p class="input_error_msg">:message</p>') !!}

                    </div>
                </div>
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="procuringParties" class="col-sm-2 col-form-label control-label">Procuring Party</label>
                    <div class="col-sm-10">
                        {!! Form::select('procuring_party_id', $procuringParties,[1], array('class' => 'form-control', 'required'=>'')) !!}
                        {!! $errors->first('procuring_party_id', '<p class="input_error_msg">:message</p>') !!}

                    </div>
                </div>
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="project_desc" class="col-sm-2 col-form-label control-label">Project Description</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('project_desc', null, array('placeholder' => 'Project Description','class' => 'form-control texteditor')) !!}
                        {!! $errors->first('project_desc', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>
                <div class="position-relative row form-group">
                <div class="col-sm-10 offset-sm-2 ">
                        <button class="pull-right btn btn-primary">Next</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
 
@endsection