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
                <div>Amendment To Original Statement Of Work
                    <div class="page-title-subheading">
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="main-card mb-3 card">
        <div class="card-body">
        {!! Form::open(array('route' => 'amendmentStore','method'=>'POST')) !!}
            @include('sows.amendment_fields')
        {!! Form::close() !!}
        </div>
    </div>
 
@endsection
