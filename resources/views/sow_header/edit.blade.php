@extends('layouts.app')

@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>
                        Edit SOW Master
                        <div class=page-title-subheading>
                        {{ Breadcrumbs::render('header_sow.edit',$ptype,$sow) }}
                        </div>
                    </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a class="btn btn-primary" href="{{ route('sow_header') }}">
                        Back
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


    {!! Form::model($sow,['method' => 'POST','route' => ['sow_header_update',$sow->id]]) !!}

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <h3>
            {{ucfirst(Lang::get('validation.attributes.'.$sow->name))}}
        </h3>
        
            <div class="form-group">
                <input type="hidden" name="sow_header_id" value="{{$sow->id}}">
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