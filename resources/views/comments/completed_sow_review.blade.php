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
                    </div>
                </div>
            </div>
            <!-- <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a class="btn btn-primary" href="{{ route('sows.index') }}"> Back</a>
                </div>
            </div> -->
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
        <div class="card-body">
            @include('sowreleated.sow_view')
            <hr>
            @include('sowreleated.all_comments')
        </div>
    </div>
    
@endsection