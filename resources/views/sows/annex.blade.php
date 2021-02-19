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
                <div>Statement Of Work (Annexure)
                    <div class="page-title-subheading">
                    {{ Breadcrumbs::render('sowAnnex', $filter, $sowResult ,  "5") }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sows.progressbar')
    

    <div class="main-card mb-3 card">
        <div class="card-body">
        {!! Form::open(array('route' => 'annexupdate','method'=>'POST')) !!}
        {!! Form::hidden('id',$sowResult->id) !!}
        {!! Form::hidden('step',6) !!}
        {!! Form::hidden('filter',$filter) !!}
                <div class="position-relative row form-group">
                    <label  class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    {!! $errors->first('general', '<div class="input_error_msg">:message</div>') !!}
                    </div>
                </div>

                <div class="position-relative row form-group">
                    <label  class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <label>Annex 1 – Agreements and Scope of Bupa Personal Data Processing</label>
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["agree_date"]) ? $attributeComments["agree_date"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required"><label for="agree_date" class="col-sm-2 col-form-label control-label">Date of agreement</label>
                    <div class="col-sm-10">
                        {!! Form::text('agree_date', $sowResult->agree_date, array('class' => 'form-control', 'readonly' => 'true', 'id'=>'agree_date')) !!}
                        {!! $errors->first('agree_date', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="party_cntlr" class="col-sm-2 col-form-label">Party acting as controller<br>(“Bupa” or “we” or “us”) </label>
                    <div class="col-sm-10">
                    <div class="col-form-label">{!!$masters['party_cntlr'] !!}</div>
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="party_proc" class="col-sm-2 col-form-label">Party acting as processor <br>(“Supplier” or “you”)</label>
                    <div class="col-sm-10">
                    <label class="col-form-label">{!! $masters['party_proc'] !!}</label>
                    </div>
                </div>

                <div class="position-relative row form-group"><label for="proc_duration" class="col-sm-2 col-form-label">Duration of processing</label>
                    <div class="col-sm-10">
                    <label class="col-form-label">{!! $masters['proc_duration'] !!}</label>
                    </div>
                </div>
           
                <div class="position-relative row form-group"><label for="proc_nature" class="col-sm-2 col-form-label">Nature and purpose of processing</label>
                    <div class="col-sm-10">
                    <label class="col-form-label">{!! $masters['proc_nature'] !!}</label>
                    </div>
                </div>
                <!-- -->
                <div class="position-relative row form-group required"><label for="proc_nature" class="col-sm-2 col-form-label control-label">Categories of data subjects</label>
                    <div class="col-sm-10">
                    <label class="col-form-label">Please select all of the categories of data subjects (individuals) who are subject to the processing: </label>
                    @foreach ($annexureAttributes['subject categories'] as $annexsubcat)
                    <div class="form-check">
                        {{ Form::checkbox('annexsubcat[]', $annexsubcat['id'],$annexsubcat->annexureValues['value'],['class' => 'form-check-input annexsubcat','id' => 'checkinput'.$annexsubcat['id']] ) }}
                        {{ Form::label('checkinput'.$annexsubcat['id'], $annexsubcat['content'],['class' => 'form-check-label']) }}  
                    </div>
                    @endforeach
                    {!! $errors->first('annexsubcat', '<p class="input_error_msg">:message</p>') !!}
                    <!-- {!! Form::hidden('annexsubcat',0,['id' => 'annexsubcat']) !!} -->
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["annexsubcat"]) ? $attributeComments["annexsubcat"] : array()])
                    @endcomponent
                </div>

             <div class="position-relative row form-group required"><label for="proc_nature" class="col-sm-2 col-form-label control-label">Type of personal data and special categories of personal data</label>
                    <div class="col-sm-10">
                    <label class="col-form-label">Please select all of the types of personal data which are subject to the processing:<br><br><b>Personal:</b>  </label>
                    @foreach ($annexureAttributes["personal data"] as $annexPersonal)
                    <?php if($annexPersonal['control_type'] == 'checkbox') {?>
                    <div class="form-check"> 
                        {{ Form::checkbox('annexPersonal[]', $annexPersonal['id'],$annexPersonal->annexureValues['value'],['class' => 'form-check-input','id' => 'checkinput'.$annexPersonal['id']] ) }}
                        {{ Form::label('checkinput'.$annexPersonal['id'],$annexPersonal['content'],['class' => 'form-check-label']) }}
                    </div>
                    <?php } ?>

                    <?php if($annexPersonal['control_type'] == 'text') {?>
                            <div class="col-sm-10">
                            <label class="col-form-label">Other Please list:</label>
                                {!! Form::text('annex_personal_other', $sowResult->annex_personal_other, array('class' => 'form-control','maxlength'=>'500')) !!}
                                {!! $errors->first('annex_personal_other', '<p class="input_error_msg">:message</p>') !!}
                           </div>
                    <?php } ?>
                    @endforeach
                    {!! $errors->first('annex_personal_other', '<p class="input_error_msg">:message</p>') !!}

                    <label class="col-form-label"><b>Special categories:</b>  </label>
                    @foreach ($annexureAttributes["special categories"] as $annexSpec)
                    <div class="form-check"> 
                        {{ Form::checkbox('annexPersonal[]', $annexSpec['id'],$annexSpec->annexureValues['value'],['class' => 'form-check-input','id' => 'checkinput'.$annexSpec['id']] ) }}
                        {{ Form::label('checkinput'.$annexSpec['id'],$annexSpec['content'],['class' => 'form-check-label']) }}
                        </div>
                    @endforeach
                    {!! $errors->first('annexPersonal', '<p class="input_error_msg">:message</p>') !!}

                    <label class="col-form-label"><b>Other:</b>  </label>
                    @foreach ($annexureAttributes["other"] as $annexOther)
                    <div class="form-check"> 
                        {{ Form::checkbox('annexOther[]', $annexOther['id'],$annexOther->annexureValues['value'],['class' => 'form-check-input','id' => 'checkinput'.$annexOther['id']] ) }}
                        {{ Form::label('checkinput'.$annexOther['id'],$annexOther['content'],['class' => 'form-check-label']) }}
                        </div>
                    @endforeach
                    {!! $errors->first('annexOther', '<p class="input_error_msg">:message</p>') !!}

                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["personaldata"]) ? $attributeComments["personaldata"] : array()])
                    @endcomponent
                </div>
            <!-- -->
    
            <div class="position-relative row form-group">
                    <label class="col-sm-2 col-form-label">Authorised Processors</label>
                    <div class="col-sm-10">
                    <label class="col-form-label">Please list:</label>
                    <div class="col-sm-10">
                        {!! Form::text('authorised_processors', $sowResult->authorised_processors, array('class' => 'form-control','maxlength'=>'500')) !!}
                        {!! $errors->first('authorised_processors', '<p class="input_error_msg">:message</p>') !!}
</div>
                    <label class="col-form-label">Note: If not completed, then there will be deemed not to be any authorised processors.</label>
                    </div>     
            </div>

                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="pull-right">
                        <button class="btn btn-primary" name="submitdraft" value="submitdraft">Save as a draft</button>
                        <button class="btn btn-primary" name="submitreview" value="submitreview">Send to review</button>
                        </div>
                        <a class="btn btn-primary" href="{{ route('sowEdit', ['filter'=>$filter, 'id' => $sowResult->id, 'step' => 4]) }}">Back</a>

                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
 
@endsection

<div id="commentModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    {!! Form::hidden('sow_id',$sowResult->id) !!}
                    {!! Form::hidden('user_id',Auth::user()->id) !!}
                        <div class="form-group">
                            <label for="edit-taunt">Comment</label>
                            <textarea name="post-body" id="post-body" rows="5" class="form-control"></textarea>
                        </div>
                    
                </form>
                <div class="comments-list col-sm-12 border-l-r d-none" id="comments-list"></div>              
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="commentable-comment-save">Save changes</button>
                
            </div>
        </div>
    </div>
</div>