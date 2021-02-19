@extends('layouts.app')

@section('breadcrumb')
   {{ Breadcrumbs::render('wfEditWithUser', $workflow, $user) }}
@endsection 

@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Update Workflow</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('managers.index') }}"> Back</a>

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


{!! Form::model($workflow, ['method' => 'PATCH','route' => ['workflows.update', $workflow->id]]) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Users:</strong>
            {{$workflow->user_id}}
            {!! Form::hidden('user_id', $workflow->user_id)!!}
            {!! Form::select('user_id', $users, $workflow->user_id, array('class' => 'form-control' ,'disabled' => 'true')) !!}

        </div>

    </div>

    
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Project Type:</strong>

            {!! Form::select('project_type_id', $projectTypes,$workflow->project_type_id, array('class' => 'form-control', 'required'=>'')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Roles:</strong>

            {!! Form::select('role_id', $roles,$workflow->role_id, array('class' => 'form-control')) !!}

        </div>

    </div>

    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}


@endsection