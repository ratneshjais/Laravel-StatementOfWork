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
                <div>Statement Of Work
                    <div class="page-title-subheading">
                    {{ Breadcrumbs::render('sowEdit', $filter, $sow ,  "4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sows.progressbar')

    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">New project</h5>
            {!! Form::model($sow, ['method' => 'PATCH','route' => ['sows.update', $sow->id ,5]]) !!}
                {!! Form::hidden('step',5) !!}
                {!! Form::hidden('filter',$filter) !!}
 
                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="applicability_deliverables" class="col-sm-2 col-form-label control-label">Applicability of Escrow for the deliverables</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('applicability_deliverables', null, array('placeholder' => 'Applicability of Escrow for the deliverables','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('applicability_deliverables', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["applicability_deliverables"]) ? $attributeComments["applicability_deliverables"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="price" class="col-sm-2 col-form-label control-label">Price (in GBP) – excluding VAT</label>
                    <div class="col-sm-10">
                        {!! Form::text('price', null, array('placeholder' => 'Price (in GBP) – excluding VAT','class' => 'form-control')) !!}
                        {!! $errors->first('price', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["price"]) ? $attributeComments["price"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="overtime_working" class="col-sm-2 col-form-label control-label">Overtime Working
 (Applicable only for T & M/FR)</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('overtime_working', null, array('placeholder' => 'Overtime Working (Applicable only for T & M/FR)','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('overtime_working', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["overtime_working"]) ? $attributeComments["overtime_working"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="payments" class="col-sm-2 col-form-label control-label">Payments</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('payments', null, array('placeholder' => 'Payments','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('payments', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["payments"]) ? $attributeComments["payments"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="out_pocket_travel_exp" class="col-sm-2 col-form-label control-label">Out of Pocket and Travel Expenses</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('out_pocket_travel_exp', null, array('placeholder' => 'Out of Pocket and Travel Expenses','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('out_pocket_travel_exp', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["out_pocket_travel_exp"]) ? $attributeComments["out_pocket_travel_exp"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="trans_back_arr" class="col-sm-2 col-form-label control-label">Transition Back Arrangements</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('trans_back_arr', null, array('placeholder' => 'Transition Back Arrangements','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('trans_back_arr', '<p class="input_error_msg">:message</p>') !!}
                   </div>
                   @component('component.sowcommentview', ['comments' => @isset($attributeComments["trans_back_arr"]) ? $attributeComments["trans_back_arr"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-group required {{ $errors->has('name') ? 'has-error' : ''}}"><label for="data_protection" class="col-sm-2 col-form-label control-label">Data Protection</label>
                    <div class="col-sm-10">
                        {!! Form::textarea('data_protection', null, array('placeholder' => 'Data Protection','class' => 'form-control texteditor', 'rows' => 6)) !!}
                        {!! $errors->first('data_protection', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["data_protection"]) ? $attributeComments["data_protection"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2 padding-l-0">
                        <a class="btn btn-primary" href="{{ route('sowEdit', ['filter'=>$filter, 'id' => $sow->id, 'step' => 3]) }}">Back</a>
                        <button class="pull-right btn btn-primary">Next</button>
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
                    {!! Form::hidden('sow_id',$sow->id) !!}
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