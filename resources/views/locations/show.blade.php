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
                  Show Location
                  <div class="page-title-subheading"> 
                      {{ Breadcrumbs::render('locations.show', $location) }}
                  </div>                                                   
                </div>                                                              
            </div>                                              
          <div class="page-title-actions">
              <div class="d-inline-block dropdown">
              <a class="btn btn-primary" href="{{ route('locations.index') }}"> Back</a>
                  </a>
              </div>
          </div>
        </div>
    </div> 

    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Location:</strong>
                {{ $location->type }}
            </div>
    </div>

@endsection