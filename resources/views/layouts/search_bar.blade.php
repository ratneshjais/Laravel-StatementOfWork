<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Search SOWs</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'search-result','method'=>'GET','class'=>'excludeform']) !!}
                        <div class="position-relative row">
                            <div class="col-md-12">
                                <label class="col-form-label">SOW Name or SOW ID:</label><br/>
                                {!! Form::text( 'search_field' , request()->search_field, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Project Type:</label><br/>
                                @foreach($projectTypes as $key => $projectType)
                                    <div class="col-md-12">
                                        {{ Form::checkbox('project_type_id[]', $projectType->id, 
                                            empty(request()->project_type_id)
                                                ?false
                                                :in_array($projectType->id, request()->project_type_id)
                                            ) }}&nbsp;&nbsp; {{ $projectType->type }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label">Procuring Party:</label><br/>
                                @foreach($procuringParties as $key => $procuringParty)
                                    {{ Form::checkbox('procuring_party_id[]', $procuringParty->id,
                                        empty(request()->procuring_party_id)
                                            ?false
                                            :in_array($procuringParty->id, request()->procuring_party_id)
                                        ) }}&nbsp;&nbsp; {{ $procuringParty->name }}<br/>
                                @endforeach
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label">Project Status:</label><br/>
                                @foreach($projectStatuses as $key => $status)
                                    {{ Form::checkbox('status[]', $key, 
                                        empty(request()->status)
                                            ?false
                                            :in_array($key, request()->status)
                                        ) }}&nbsp;&nbsp;{{ Lang::get('status.'.$status) }}<br/>
                                @endforeach
                            </div>
                            <!--<div class="col-sm-2 offset-sm-2">-->
                            <div class="col-sm-12">
                                <button class="btn btn-primary" name="search">Apply Filters</button>
                                @if(Route::current()->getName() == 'search-result')
                                    <a class="btn btn-secondary" href="{{ route('search-result') }}">Clear Filters</a>
                                @endif
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>