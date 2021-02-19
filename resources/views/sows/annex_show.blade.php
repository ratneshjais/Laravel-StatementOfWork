 
         
                <div class="position-relative row form-group"><label  class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10 col-form-label">
                        <h5>Annex 1 – Agreements and Scope of Bupa Personal Data Processing</h5>
                    </div>
                </div>

                <div class="position-relative row">
                    <label for="agree_date" class="col-sm-2 col-form-label">Date of agreement</label>
                    <div class="col-sm-10 col-form-label @if ($active) commentable @endif " @if ($active) data-comment-for="agree_date" @endif>
                        {{date("d-F-Y",strtotime($sow->agree_date))}}
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["agree_date"]) ? $attributeComments["agree_date"] : array()])
                    @endcomponent
                </div>

                <div class="position-relative row">
                    <label for="party_cntlr" class="col-sm-2 col-form-label">Party acting as controller<br>(“Bupa” or “we” or “us”) </label>
                    <div class="col-sm-10">
                        <label class="col-form-label">{!! $masters['party_cntlr'] !!}</label>
                    </div>
                </div>

                <div class="position-relative row">
                    <label for="party_proc" class="col-sm-2 col-form-label">Party acting as processor <br>(“Supplier” or “you”)</label>
                    <div class="col-sm-10">
                    <label class="col-form-label"> {!! $masters['party_proc'] !!} </label>
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
                <div class="position-relative row form-group"><label for="proc_nature" class="col-sm-2 col-form-label">Categories of data subjects</label>
                    <div class="col-sm-10 @if ($active) commentable @endif " @if ($active) data-comment-for="annexsubcat" @endif>
                        <label class="col-form-label">Please select all of the categories of data subjects (individuals) who are subject to the processing: </label>
                        @foreach ($annexureAttributes['subject categories'] as $annexsubcat)
                            <div class="form-check">
                                {{ Form::checkbox('annex[]', $annexsubcat['id'],$annexsubcat->annexureValues->value,['class' => 'form-check-input','disabled'=>'','id' => 'checkinput'.$annexsubcat['id']] ) }}
                                {{ Form::label('checkinput'.$annexsubcat['id'], $annexsubcat['content'],['class' => 'form-check-label']) }}  
                            </div>
                        @endforeach
                    </div>
                    @component('component.sowcommentview', ['comments' => @isset($attributeComments["annexsubcat"]) ? $attributeComments["annexsubcat"] : array()])
                    @endcomponent
                </div>

             <div class="position-relative row form-group"><label for="proc_nature" class="col-sm-2 col-form-label">Type of personal data and special categories of personal data</label>
                <div class="col-sm-10 @if ($active) commentable @endif " @if ($active) data-comment-for="personaldata" @endif>
                    <label class="col-form-label">Please select all of the types of personal data which are subject to the processing:<br><br><b>Personal:</b>  </label>
                    @foreach ($annexureAttributes["personal data"] as $annexPersonal)
                        @if($annexPersonal['control_type'] == 'checkbox') 
                            <div class="form-check"> 
                                {{ Form::checkbox('annex[]', $annexPersonal['id'],$annexPersonal->annexureValues->value,['class' => 'form-check-input','disabled'=>'','id' => 'checkinput'.$annexPersonal['id']] ) }}
                                {{ Form::label('checkinput'.$annexPersonal['id'],$annexPersonal['content'],['class' => 'form-check-label']) }}
                            </div>
                        @endif
                        @if($annexPersonal['control_type'] == 'text')
                            <div class="col-sm-10">
                                <label class="col-form-label"></label>
                                <p>Other: @if( $sow->annex_personal_other != '') {!! $sow->annex_personal_other !!} @else {!!'-'!!} @endif</p>
                            </div>
                        @endif
                    @endforeach

                    <label class="col-form-label"><b>Special categories:</b>  </label>
                    @foreach ($annexureAttributes["special categories"] as $annexSpec)
                        <div class="form-check"> 
                            {{ Form::checkbox('annex[]', $annexSpec['id'],$annexSpec->annexureValues->value,['class' => 'form-check-input','disabled'=>'','id' => 'checkinput'.$annexSpec['id']] ) }}
                            {{ Form::label('checkinput'.$annexSpec['id'],$annexSpec['content'],['class' => 'form-check-label']) }}
                        </div>
                    @endforeach

                    <label class="col-form-label"><b>Other:</b>  </label>
                    @foreach ($annexureAttributes["other"] as $annexOther)
                        <div class="form-check"> 
                            {{ Form::checkbox('annex[]', $annexOther['id'],$annexOther->annexureValues->value,['class' => 'form-check-input','disabled'=>'','id' => 'checkinput'.$annexOther['id']] ) }}
                            {{ Form::label('checkinput'.$annexOther['id'],$annexOther['content'],['class' => 'form-check-label']) }}
                        </div>
                    @endforeach
                </div>
                @component('component.sowcommentview', ['comments' => @isset($attributeComments["personaldata"]) ? $attributeComments["personaldata"] : array()])
                @endcomponent
            </div>
    
            <div class="position-relative row form-group">
                    <label class="col-sm-2 col-form-label">Authorised Processors</label>
                    <div class="col-sm-10">
                   
                        <div class="col-sm-10">
                           <p> @if( $sow->authorised_processors != '') {!! $sow->authorised_processors !!} @else {!!'-'!!} @endif</p> 
                        </div>
                        <label class="col-form-label">Note: If not completed, then there will be deemed not to be any authorised processors.</label>
                    </div>    
            </div>
             
 
 