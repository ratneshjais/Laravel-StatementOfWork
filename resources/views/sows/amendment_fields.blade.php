<div class="position-relative row form-group">
                    <label  class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    {!! $errors->first('general', '<div class="input_error_msg">:message</div>') !!}
                    </div>
                </div>

                <div class="position-relative row form-group required"><label for="sow_id" class="col-sm-2 col-form-label control-label">SOW</label>
                    <div class="col-sm-10">
                    <select name="sow_id" id="sow_id" class="form-control">
                        @foreach($all_sow as $item)
                            <option value="{{ $item->id }}"{{ ($sow !='' && $sow->sow_id == $item->id )? 'selected=selected'  : '' }}>{{ $item->sow_code}} : {{ $item->project_name }}</option>
                        @endforeach
                    </select>
                        {!! $errors->first('sow_id', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>
               
                <div class="position-relative row form-group required"><label for="effective_from" class="col-sm-2 col-form-label control-label">Effective From</label>
                    <div class="col-sm-10">
                        {!! Form::text('effective_from', null,  array('class' => 'form-control', 'readonly' => 'true', 'id'=>'effective_from')) !!}
                        {!! $errors->first('effective_from', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>

                <div class="position-relative row form-group required"><label for="dated" class="col-sm-2 col-form-label control-label">Dated</label>
                <div class="col-sm-10">
                        {!! Form::text('dated', null, array('class' => 'form-control', 'readonly' => 'true', 'id'=>'dated')) !!}
                        {!! $errors->first('dated', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>

                <div class="position-relative row form-group required">
                    <label for="amendment_for" class="col-sm-2 col-form-label control-label">This amendment is for</label>
                    <div class="col-sm-10">
                        {!! Form::text('amendment_for', null, array('class' => 'form-control',  'id'=>'amendment_for')) !!}
                        {!! $errors->first('amendment_for', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>
           
                <div class="position-relative row form-group required"><label for="original_end_date" class="col-sm-2 col-form-label control-label">Original End date</label>
                    <div class="col-sm-10">
                        {!! Form::text('original_end_date',null,  array('class' => 'form-control', 'readonly' => 'true', 'id'=>'original_end_date')) !!}
                        {!! $errors->first('original_end_date', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>

                <div class="position-relative row form-group required"><label for="revised_end_date" class="col-sm-2 col-form-label  control-label">Revised End date</label>
                    <div class="col-sm-10">
                        {!! Form::text('revised_end_date',  null, array('class' => 'form-control', 'readonly' => 'true', 'id'=>'revised_end_date')) !!}
                        {!! $errors->first('revised_end_date', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>


                <div class="position-relative row form-group required"><label for="rate" class="col-sm-2 col-form-label control-label">Per day Rate Applicable for the new – GBP</label>
                     <div class="col-sm-3">
                        {!! Form::text('rate', null,  array('class' => 'form-control',  'id'=>'rate')) !!}
                        {!! $errors->first('rate', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>

                <div class="position-relative row form-group required">
                    <label for="rate_vat" class="col-sm-2 col-form-label control-label">Excluding VAT</label>
                    <div class="col-sm-3">
                        {!! Form::text('rate_vat', null,  array('class' => 'form-control',  'id'=>'rate_vat')) !!}
                        {!! $errors->first('rate_vat', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>

                <div class="position-relative row form-group required"><label for="data_protection" class="col-sm-2 col-form-label control-label">Data Protection</label>
                <div class="col-sm-10">
                        {!! Form::textarea('data_protection', $data_protection[1],  array('class' => 'form-control texteditor', 'id'=>'data_protection', 'rows' => 2)) !!}
                        {!! $errors->first('data_protection', '<p class="input_error_msg">:message</p>') !!}
                    </div>
                </div>

                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2">
                        <button class="btn btn-primary" name="submitdraft" value="submitdraft">Save as a draft</button>
                        <button class="btn btn-primary" name="submitreview" value="submitreview">Send to review</button>
                    </div>
                </div>
