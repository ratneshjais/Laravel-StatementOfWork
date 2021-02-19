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
                SOW Header Management
                <div class=page-title-subheading>
                    {{ Breadcrumbs::render('header_sow') }}
                </div>
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
                            <input type="text" id="h_name" placeholder="Search By Header Name" autocomplete="off" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <select id="p_type" class="form-control">
                                <option value="">Search By Project Type</option>
                                <option value="1">T&M</option>
                                <option value="2">FR</option>
                                <option value="3">FP</option>
                                <option value="4">Others</option>
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
               <table class="mb-0 table table-striped" id="SowHeaderDatatables">
                   <thead>
                        <tr>
                            <th width="100px">Sr No.</th>
                            <th>Project Type </th>
                            <th>Project Header Name</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection