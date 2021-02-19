<div class="main-card mb-3">
                <div class="card-body">
                    {!! $sow->headerDesc[0]->content !!}
                    
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["project_name"]) ? $attributeComments["project_name"] : array() , 'active' => $active])
                            @slot('controlName') project_name @endslot
                            @slot('controlLable') Project Name @endslot
                            @slot('controlValue') {{$sow->project_name}} @endslot
                        @endcomponent
                    
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["project_type"]) ? $attributeComments["project_type"] : array() , 'active' => $active ])
                            @slot('controlName') project_type @endslot
                            @slot('controlLable') Project Type @endslot
                            @slot('controlValue') {{$sow->project_type->type}} @endslot
                        @endcomponent
                    
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["procuringParties"]) ? $attributeComments["procuringParties"] : array() , 'active' => $active ])
                            @slot('controlName') procuringParties @endslot
                            @slot('controlLable') Procuring Party @endslot
                            @slot('controlValue') {{$sow->procuring_party->name}} @endslot
                        @endcomponent
                    
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["project_desc"]) ? $attributeComments["project_desc"] : array() , 'active' => $active ])
                            @slot('controlName') project_desc @endslot
                            @slot('controlLable') Project Description @endslot
                            @slot('controlValue') {!! $sow->project_desc !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["act_scope_work"]) ? $attributeComments["act_scope_work"] : array() , 'active' => $active ])
                            @slot('controlName') act_scope_work @endslot
                            @slot('controlLable') Activities/Scope of work @endslot
                            @slot('controlValue') {!! $sow->act_scope_work !!} @endslot
                        @endcomponent 

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["skills_tech_abilities"]) ? $attributeComments["skills_tech_abilities"] : array() , 'active' => $active ])
                            @slot('controlName') skills_tech_abilities @endslot
                            @slot('controlLable') Skills and Technical Abilities @endslot
                            @slot('controlValue') {!! $sow->skills_tech_abilities !!} @endslot
                        @endcomponent 

                  @if($sow->project_type->type != 'FP')
                    <div class="position-relative row ">
                            <label for="skills_tech_abilities" class="col-sm-2  col-form-label border">Team Composition</label>
                            <div class="col-sm-10  col-form-label border @if ($active) commentable @endif " @if ($active) data-comment-for="team_composition" @endif >
                                <table id="team_composition_table"  data-sow-id='{{ $sow->id }}' data-state='inactive'></table>
                            </div>
                            
                            @component('component.sowcommentview', ['comments' => @isset($attributeComments["team_composition"]) ? $attributeComments["team_composition"] : array()])
                            @endcomponent
                    </div>
                    @endif
                    
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["infra_cust"]) ? $attributeComments["infra_cust"] : array() , 'active' => $active ])
                            @slot('controlName') infra_cust @endslot
                            @slot('controlLable') Infrastructure from Customer @endslot
                            @slot('controlValue') {!! $sow->infra_cust !!} @endslot
                        @endcomponent 

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["infra_supp"]) ? $attributeComments["infra_supp"] : array() , 'active' => $active ])
                            @slot('controlName') infra_supp @endslot
                            @slot('controlLable') Infrastructure from Supplier @endslot
                            @slot('controlValue') {!! $sow->infra_supp !!} @endslot
                        @endcomponent 

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["location_id"]) ? $attributeComments["location_id"] : array() , 'active' => $active ])
                            @slot('controlName') location_id @endslot
                            @slot('controlLable') Location @endslot
                            @slot('controlValue')   
                                                    @if (!empty($sow->location))  {{ $sow->location->type}} 
                                                    @endif  
                            @endslot
                        @endcomponent 
                        
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["work_days"]) ? $attributeComments["work_days"] : array() , 'active' => $active ])
                            @slot('controlName') work_days @endslot
                            @slot('controlLable') Work Days/Work Hours/Work Holidays @endslot
                            @slot('controlValue') {!! $sow->work_days !!} @endslot
                        @endcomponent

                        <div class="position-relative row ">
                            <label  class="col-sm-2  col-form-label border">Dates</label>
                            <div class="col-sm-10">
                                    @component('component.sowcontrolview', ['comments' => @isset($attributeComments["start_date"]) ? $attributeComments["start_date"] : array() , 'active' => $active ])
                                        @slot('controlName') start_date @endslot
                                        @slot('controlLable') Start Date @endslot
                                        @slot('controlValue') {!! date("d-F-Y",strtotime($sow->start_date)) !!} @endslot
                                    @endcomponent

                                    @component('component.sowcontrolview', ['comments' => @isset($attributeComments["end_date"]) ? $attributeComments["end_date"] : array() , 'active' => $active ])
                                        @slot('controlName') end_date @endslot
                                        @slot('controlLable') End Date @endslot
                                        @slot('controlValue') {!! date("d-F-Y",strtotime($sow->end_date))!!} @endslot
                                    @endcomponent
                            </div>
                    </div>

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["work_allocation"]) ? $attributeComments["work_allocation"] : array() , 'active' => $active ])
                            @slot('controlName') work_allocation @endslot
                            @slot('controlLable') Work Allocation @endslot
                            @slot('controlValue') {!! $sow->work_allocation !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["progress_reporting"]) ? $attributeComments["progress_reporting"] : array() , 'active' => $active ])
                            @slot('controlName') progress_reporting @endslot
                            @slot('controlLable') Progress Reporting @endslot
                            @slot('controlValue') {!! $sow->progress_reporting !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["acceptance_criteria"]) ? $attributeComments["acceptance_criteria"] : array() , 'active' => $active ])
                            @slot('controlName') acceptance_criteria @endslot
                            @slot('controlLable') Acceptance Criteria or Fulfilment of SoW* @endslot
                            @slot('controlValue') {!! $sow->acceptance_criteria !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["slas_agreed"]) ? $attributeComments["slas_agreed"] : array() , 'active' => $active ])
                            @slot('controlName') slas_agreed @endslot
                            @slot('controlLable') SLAs Agreed @endslot
                            @slot('controlValue') {!! $sow->slas_agreed !!} @endslot
                        @endcomponent

                    <div class="position-relative row ">
                            <label  class="col-sm-2  col-form-label border">Line Managers / Reporting To</label>
                            <div class="col-sm-10">
                                    @component('component.sowcontrolview', ['comments' => @isset($attributeComments["customerManager"]) ? $attributeComments["customerManager"] : array() , 'active' => $active ])
                                        @slot('controlName') customerManager @endslot
                                        @slot('controlLable') CUSTOMER Manager @endslot
                                        @slot('controlValue') 
                                                                @if (!empty($sow->customerManager))
                                                                    {{$sow->customerManager->name}}
                                                                @endif 
                                        @endslot
                                    @endcomponent

                                    @component('component.sowcontrolview', ['comments' => @isset($attributeComments["supplierManager"]) ? $attributeComments["supplierManager"] : array() , 'active' => $active ])
                                        @slot('controlName') supplierManager @endslot
                                        @slot('controlLable') SUPPLIER Delivery Manager @endslot
                                        @slot('controlValue') 
                                                                @if (!empty($sow->supplierManager))
                                                                    {{$sow->supplierManager->name}}
                                                                @endif 
                                        @endslot
                                    @endcomponent
                            </div>
                    </div>
                    
                    @if($sow->project_type->type == 'FP')
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["change_control"]) ? $attributeComments["change_control"] : array() , 'active' => $active ])
                            @slot('controlName') change_control @endslot
                            @slot('controlLable') Change Control (Applicable for Fixed Price) @endslot
                            @slot('controlValue') {!! $sow->change_control !!} @endslot
                        @endcomponent 

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["risk_mitigation_plans"]) ? $attributeComments["risk_mitigation_plans"] : array() , 'active' => $active ])
                            @slot('controlName') risk_mitigation_plans @endslot
                            @slot('controlLable') Risks & Mitigation Plans (Applicable for Fixed Price) @endslot
                            @slot('controlValue') {!! $sow->risk_mitigation_plans !!} @endslot
                        @endcomponent 
                    @endif

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["extension"]) ? $attributeComments["extension"] : array() , 'active' => $active ])
                            @slot('controlName') extension @endslot
                            @slot('controlLable') Extension (Applicable for T & M & FR) @endslot
                            @slot('controlValue') {!! $sow->extension !!} @endslot
                        @endcomponent 

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["cancellation"]) ? $attributeComments["cancellation"] : array() , 'active' => $active ])
                            @slot('controlName') cancellation @endslot
                            @slot('controlLable') Cancellation / Delay / Early Termination @endslot
                            @slot('controlValue') {!! $sow->cancellation !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["applicability_deliverables"]) ? $attributeComments["applicability_deliverables"] : array() , 'active' => $active ])
                            @slot('controlName') applicability_deliverables @endslot
                            @slot('controlLable') Applicability of Escrow for the deliverables @endslot
                            @slot('controlValue') {!! $sow->applicability_deliverables !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["price"]) ? $attributeComments["price"] : array() , 'active' => $active ])
                            @slot('controlName') price @endslot
                            @slot('controlLable') Price (in GBP) – excluding VAT @endslot
                            @slot('controlValue') {!! $sow->price !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["overtime_working"]) ? $attributeComments["overtime_working"] : array() , 'active' => $active ])
                            @slot('controlName') overtime_working @endslot
                            @slot('controlLable') Overtime Working (Applicable only for T & M/FR) @endslot
                            @slot('controlValue') {!! $sow->overtime_working !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["payments"]) ? $attributeComments["payments"] : array() , 'active' => $active ])
                            @slot('controlName') payments @endslot
                            @slot('controlLable') Payments @endslot
                            @slot('controlValue') {!! $sow->payments !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["out_pocket_travel_exp"]) ? $attributeComments["out_pocket_travel_exp"] : array() , 'active' => $active ])
                            @slot('controlName') out_pocket_travel_exp @endslot
                            @slot('controlLable') Out of Pocket and Travel Expenses @endslot
                            @slot('controlValue') {!! $sow->out_pocket_travel_exp !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["trans_back_arr"]) ? $attributeComments["trans_back_arr"] : array() , 'active' => $active ])
                            @slot('controlName') trans_back_arr @endslot
                            @slot('controlLable') Transition Back Arrangements @endslot
                            @slot('controlValue') {!! $sow->trans_back_arr !!} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["data_protection"]) ? $attributeComments["data_protection"] : array() , 'active' => $active ])
                            @slot('controlName') data_protection @endslot
                            @slot('controlLable') Data Protection @endslot
                            @slot('controlValue') {!! $sow->data_protection !!} @endslot
                        @endcomponent
                </div>
            </div>