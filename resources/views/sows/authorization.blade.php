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
                @if($sow->type == 'sow')
                <div>Statement Of Work
                    <div class="page-title-subheading">
                    {{ Breadcrumbs::render('sowEdit', $filter, $sow ,  "6") }}
                    </div>
                </div>
                @else
                <div>Amendments
                    <div class="page-title-subheading">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if($sow->type == 'sow')

    @include('sows.progressbar')

    @endif

    <div class="main-card mb-3 card">
        <div class="card-body">
            {!! $errors->first('general', '<div class="input_error_msg">:message</div>') !!}
            <h5 class="card-title">Reviewer Selection</h5>
            {!! Form::open(array('route' => 'authorizationUpdate','method'=>'POST')) !!} 
                {!! Form::hidden('id',$sow->id) !!}
                @if($sow->type == 'sow')
                        {!! Form::hidden('step',6) !!}
                        {!! Form::hidden('filter',$filter) !!}
                @endif
                    <label class="col-form-label"><b>Please select all of the applicable reviewers from following list:</b>  </label>
                    @foreach ($reviewerList  as $reviewer)
                    <div class="form-check"> 
                        {{ Form::checkbox('reviewer[]', $reviewer['user']['id'],in_array($reviewer['user']['id'],$sow_authorizationsList) ,['class' => 'form-check-input','id' => 'checkinput'.$reviewer['user']['id']] ) }}
                        {{ Form::label('checkinput'.$reviewer['user']['id'],$reviewer['user']['name'],['class' => 'form-check-label'])}}
                    </div>
                    @endforeach
                </div>

                <div class="position-relative row form-check">
                    <div class="col-sm-10 padding-l-0">
                    @if($sow->type == 'sow')
                        <a class="btn btn-primary" href="{{ route('sowEdit', ['filter'=>$filter, 'id' => $sow->id, 'step' => 5]) }}">Back</a>
                    @else
                    <a class="btn btn-primary" href="{{ route('amendmentUpdate', ['id' => $sow->id]) }}">Back</a>

                    @endif    
                        <button class="btn btn-success" name="submitreview" value="submitreview">Finish</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
 
@endsection