@extends('layouts.app')

@section('breadcrumb')
   {{ Breadcrumbs::render('wfCreateWithUser', $user) }}
@endsection 

@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Create New Workflow : {{$user->name}}</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('users.edit' , $user->id) }}"> Back</a>

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



{!! Form::open(array('route' => 'wfStoreWithUser','method'=>'POST')) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
         
        <div class="form-group">

            <strong>Project Type:</strong>

            {!! Form::select('project_type_id', $projectTypes,[], array('class' => 'form-control', 'required'=>'')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Roles:</strong>

            {!! Form::select('role_id', $roles,[], array('class' => 'form-control')) !!}

        </div>

    </div>

    {!! Form::hidden('user_id', $user->id)!!}

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}


@endsection