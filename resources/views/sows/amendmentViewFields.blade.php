<div class="main-card mb-3">
                <div class="card-body">       
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["project_name"]) ? $attributeComments["project_name"] : array() , 'active' => $active])
                            @slot('controlName') project_name @endslot
                            @slot('controlLable') Project Name @endslot
                            @slot('controlValue') {{$sow->project_name}} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["effective_from"]) ? $attributeComments["effective_from"] : array() , 'active' => $active])
                            @slot('controlName') effective_from @endslot
                            @slot('controlLable') Effective From @endslot
                            @slot('controlValue') {{$sow->effective_from}} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["dated"]) ? $attributeComments["dated"] : array() , 'active' => $active])
                            @slot('controlName') dated @endslot
                            @slot('controlLable') Dated @endslot
                            @slot('controlValue') {{$sow->dated }} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["amendment_for"]) ? $attributeComments["amendment_for"] : array() , 'active' => $active])
                            @slot('controlName') amendment_for @endslot
                            @slot('controlLable') This amendment is for @endslot
                            @slot('controlValue') {{$sow->amendment_for }} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["original_end_date"]) ? $attributeComments["original_end_date"] : array() , 'active' => $active])
                            @slot('controlName') original_end_date @endslot
                            @slot('controlLable') Original End date @endslot
                            @slot('controlValue') {{$sow->original_end_date }} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["revised_end_date"]) ? $attributeComments["revised_end_date"] : array() , 'active' => $active])
                            @slot('controlName') revised_end_date @endslot
                            @slot('controlLable') Revised End date @endslot
                            @slot('controlValue') {{$sow->revised_end_date }} @endslot
                        @endcomponent
                                    
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["rate"]) ? $attributeComments["rate"] : array() , 'active' => $active])
                            @slot('controlName') rate @endslot
                            @slot('controlLable') Per day Rate Applicable for the new – GBP @endslot
                            @slot('controlValue') {{$sow->rate }} @endslot
                        @endcomponent

                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["rate_vat"]) ? $attributeComments["rate_vat"] : array() , 'active' => $active])
                            @slot('controlName') rate_vat @endslot
                            @slot('controlLable') Excluding VAT @endslot
                            @slot('controlValue') {{$sow->rate_vat }} @endslot
                        @endcomponent
                        
                        @component('component.sowcontrolview', ['comments' => @isset($attributeComments["data_protection"]) ? $attributeComments["data_protection"] : array() , 'active' => $active])
                            @slot('controlName') data_protection @endslot
                            @slot('controlLable') Data Protection @endslot
                            @slot('controlValue') {{$sow->data_protection }} @endslot
                        @endcomponent
                </div>
              </div>