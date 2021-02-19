@extends('layouts.app')
  
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>
                        Managers Management
                        <div class="page-title-subheading">
                        {{ Breadcrumbs::render('managers.index') }}
                        </div>
                    </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a type="button" class="btn-shadow btn btn-success" href="{{ route('managers.create') }}">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="pe-7s-add-user"></i>
                        </span>
                        Create New Manager
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
                    <b>Filters</b>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" id="s_b_name" placeholder="Search By Name" autocomplete="off" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <select id="s_b_type" class="form-control">
                                <option value="">Search By Manager Type</option>
                                <option value="customer">Customer</option>
                                <option value="supplier">Supplier</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                   <table class="mb-0 table table-striped" id="ManagerDatatables" >
                       <thead>
                        <tr>
                            <th width="150px">Sr No.</th>
                            <th>Name</th>
                            <th>Manager Type</th>
                            <th width="100px">Action</th>
                        </tr>
                       </thead>
                  </table>
                </div>
            </div>
        </div>
    </div>


@endsection