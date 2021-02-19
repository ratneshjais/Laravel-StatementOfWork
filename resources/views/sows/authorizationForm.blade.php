<div class="main-card mb-3 card">
        <div class="card-body">
            {!! $errors->first('general', '<div class="input_error_msg">:message</div>') !!}
            <h5 class="card-title">Reviewer Selection</h5>
            {!! Form::open(array('route' => 'authorizationUpdate','method'=>'POST')) !!} 
                {!! Form::hidden('step',6) !!}
                {!! Form::hidden('id',$sow->id) !!}
                {!! Form::hidden('filter',$filter) !!}
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
                        <a class="btn btn-primary" href="{{ route('sowEdit', ['filter'=>$filter, 'id' => $sow->id, 'step' => 5]) }}">Back</a>
                        <button class="btn btn-success" name="submitreview" value="submitreview">Finish</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>