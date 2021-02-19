@extends('layouts.app')

@section('content')
<div class="app-page-title">
  <div class="page-title-wrapper">
      <div class="page-title-heading">
          <div class="page-title-icon">
              <i class="pe-7s-plus icon-gradient bg-happy-itmeo">
              </i>
          </div>
          <div>SOW Management</div>
      </div>
      <div class="page-title-actions">
          <div class="d-inline-block dropdown">
              <a type="button" class="btn-shadow btn btn-success" href="{{ route('sows.create') }}">
                  <span class="btn-icon-wrapper pr-2 opacity-7">
                      <i class="pe-7s-plus"></i>
                  </span>
                  Create New SOW
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
                     <th>Type</th>
                     <th>Party</th>
                     <th width="280px">Action</th>
                   </tr>

                   @foreach ($data as $key => $sows)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $sows->project_name }}</td>
                      <td>{{ $sows->project_type->type }}</td>
                      <td>{{ $sows->procuring_party->name }}</td>
                      
                      <td>
                      <a class="btn btn-info" href="{{ route('sows.show',$sows->id) }}">Show</a>
                      <a class="btn btn-primary" href="{{ route('sows.edit',$sows->id) }}">Edit</a>
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