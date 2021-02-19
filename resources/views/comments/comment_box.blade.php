            {!! Form::open(array('route' => 'comment_store','method'=>'POST')) !!}

                <div class="position-relative row form-group">
                    <div class="col-sm-12 ">
                        {!! Form::textarea('comments', null, array('placeholder' => 'Enter Your Comments','class' => 'form-control', 'rows' => 4)) !!}
                        {!! Form::hidden('user_id', auth::user()->id)!!}
                        {!! Form::hidden('sow_id', $sow->id)!!}
                        {!! Form::hidden('filter', $filter)!!}
                        {!! Form::hidden('sowType', $sow->type)!!}
                    </div>
                </div>


                <div class="position-relative row form-group">
                    <div class="col-sm-2">
                        <button name="status" class="btn btn-success" value="approve">Approve</button>
                        <button name="status" class="btn btn-danger" value="reject">Reject</button>
                    </div>
                </div>
                
            {!! Form::close() !!}