<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="">                    
                    <h4 class="pull-left">
                        Workflows
                        <a class="btn btn-primary pull-right" href="{{ route('wfCreateWithUser',$user->id) }}">
                            <i class="fa fa-plus"></i> Add 
                        </a>
                    </h4>
                   
                </div>    
                <table class="mb-0 table table-striped" >
                    <tr>
                     <thead>
                        <th>Project Type</th>
                        <th>Role</th> 
                        <th width="280px">Action</th>
                     <thead>
                    </tr>

                    @foreach ($workflows as $key => $workflow)
                    <tr>
                      
                      <td>{{ $workflow->project_type->type }}</td>
                      <td>{{ $workflow->role->name }}</td>
                      <td>
                        <a class="btn btn-primary" href="{{ route('wfEditWithUser',$workflow->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['workflows.destroy', $workflow->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                      </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>