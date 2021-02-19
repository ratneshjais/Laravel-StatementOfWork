@extends('layouts.app')

@section('content')
<div class="app-page-title">
  <div class="page-title-wrapper">
      <div class="page-title-heading">
          <div class="page-title-icon">
              <i class="pe-7s-users icon-gradient bg-happy-itmeo">
              </i>
          </div>
          <div>Users Management
              <div class="page-title-subheading">{{ Breadcrumbs::render('users.index') }}
              </div>
          </div>
      </div>
      <div class="page-title-actions">
          <div class="d-inline-block dropdown">
              <a type="button" class="btn-shadow btn btn-success" href="{{ route('users.create') }}">
                  <span class="btn-icon-wrapper pr-2 opacity-7">
                      <i class="pe-7s-add-user"></i>
                  </span>
                  Create New User
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
                     <th>No</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Roles</th>
                     <th width="280px">Action</th>
                   </tr>

                   @foreach ($data as $key => $user)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @if(!empty($user->getRoleNames()))
                          @foreach($user->getRoleNames() as $v)
                             <label class="badge badge-success">{{ $v }}</label>
                          @endforeach
                        @endif
                      </td>
                      <td>
                         <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                         <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                          <!-- {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!} -->
                      </td>
                    </tr>
                   @endforeach
              </table>
            </div>
        </div>
    </div>
</div>


{!! $data->render() !!}


@endsection