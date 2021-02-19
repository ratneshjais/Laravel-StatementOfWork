@extends('layouts.app')

@section('content')


    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon title-clipboard-icon">
                    <i class="pe-7s-upload"></i>
                </div>
                <div>Statement Of Work
                    <div class="page-title-subheading">
                    {{Breadcrumbs::render('sowViewUpload', $filter, $sow)}}
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
         
                <a class="btn btn-primary"  href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
                     Back
                    </a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

        </div>

    @endif
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
        <div class="card-body">
            {!! Form::open(['route' => 'uploaded_file.upload.post','method'=>'POST', 'files' => TRUE]) !!}
                {!! Form::hidden('sow_id',request('sow_id')) !!}
                {!! Form::hidden('filter',request('filter')) !!}
                <div class="position-relative row form-group">
                    <label for="uploaded_file" class="col-sm-2 col-form-label">Upload SOW</label>
                    <div class="col-sm-6">                        
                        {!! Form::file('uploaded_file', ['class' => 'form-control', 'required'=>TRUE, 'style'=> "padding:3px"
]) !!}
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label for="uploaded_file" class="col-sm-2 col-form-label">Upload SOW</label>
                    <div class="col-sm-10">
                        {!! Form::submit('Upload',['class'=>'btn btn-success']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
    </div>
 
@endsection