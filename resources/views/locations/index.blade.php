@extends('layouts.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
          <div class="page-title-icon">
              <i class="pe-7s-map-marker icon-gradient bg-happy-itmeo">
              </i>
          </div>
          <div>
                Locations Management
                <div class="page-title-subheading"> 
                    {{ Breadcrumbs::render('locations.index') }}
                </div>                                                   
          </div>                                                              
        </div>                                              
      <div class="page-title-actions">
          <div class="d-inline-block dropdown">
              <a type="button" class="btn-shadow btn btn-success" href="{{ route('locations.create') }}">
                  <span class="btn-icon-wrapper pr-2 opacity-7">
                      <i class="pe-7s-add-user"></i>
                  </span>
                  Create New Location
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
                <table class="mb-0 table table-striped " id="locationDatatables" >
                    <thead>
                        <tr>
                         <th width="150px">Sr No.</th>
                         <th>Location</th>
                         <th width="100px">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


{!! $data->render() !!}


@endsection