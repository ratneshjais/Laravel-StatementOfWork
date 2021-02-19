@extends('layouts.app')

@section('content')
<div class="app-page-title">
  <div class="page-title-wrapper">
      <div class="page-title-heading">
          <div class="page-title-icon">
              <i class="pe-7s-users icon-gradient bg-happy-itmeo">
              </i>
          </div>
          <div>Workflow Management</div>
      </div>
      <div class="page-title-actions">
          <div class="d-inline-block dropdown">
              <a type="button" class="btn-shadow btn btn-success" href="{{ route('workflows.create') }}">
                  <span class="btn-icon-wrapper pr-2 opacity-7">
                      <i class="pe-7s-add-user"></i>
                  </span>
                  Create New Workflow
              </a>
          </div>
      </div>
  </div>
</div> 

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>

@endif

<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
               <table class="mb-0 table table-striped" >
                   <tr>
                     <th>Project Type</th>
                     <th>Role</th>
                     <th>User</th>
                     <th width="280px">Action</th>
                   </tr>
                
                   @foreach ($workflows as $key => $workflow)
                    <tr>
                      <td>{{ $workflow->project_type->type }}</td>
                      <td>{{ $workflow->role->name }}</td>
                      <td>{{ $workflow->user->name }}</td>
                      <td>
                         <a class="btn btn-info" href="{{ route('workflows.show',$workflow->id) }}">Show</a>
                         <a class="btn btn-primary" href="{{ route('workflows.edit',$workflow->id) }}">Edit</a>
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

{!! $workflows->render() !!}



@endsection