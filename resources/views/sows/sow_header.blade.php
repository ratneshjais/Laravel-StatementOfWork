@extends('layouts.app')


@section('content')

<div class="app-page-title">
  <div class="page-title-wrapper">
      <div class="page-title-heading">
          <div class="page-title-icon">
              <i class="pe-7s-pen icon-gradient bg-happy-itmeo">
              </i>
          </div>
          <div>Alter 'SOW' Header
          <div class="page-title-subheading">
                {{ Breadcrumbs::render('header_sow') }}
                </div>
          </div>
      </div>
      <div class="page-title-actions">
          <div class="d-inline-block dropdown">
              <a type="button" class="btn-shadow btn btn-danger" href="{{ route('home') }}">
                  <!-- <span class="btn-icon-wrapper pr-2 opacity-7">
                      <i class="pe-7s-x"></i>
                  </span> -->
                  Cancel
              </a>
          </div>
      </div>
  </div>
</div> 


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>

@endif


{!! Form::model(['method' => 'POST','route' => ['SowHeaderUpdate']]) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

        <textarea class="form-control texteditor" name="header_value">
            {{$sow->content}}
        </textarea>

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}


@endsection