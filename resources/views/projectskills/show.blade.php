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
                    Show Project Skills
                    <div class=page-title-subheading>
                    {{ Breadcrumbs::render('projectskills.show', $projectskill) }}
                    </div>
                </div>
          </div>
          <div class="page-title-actions">
              <div class="d-inline-block dropdown">
                  <a class="btn btn-primary" href="{{ route('projectskills.index') }}">
                    Back
                  </a>
              </div>
          </div>
      </div>
    </div> 
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $projectskill->name }}
               </div>
             </div>
        </div>
    </div>

@endsection