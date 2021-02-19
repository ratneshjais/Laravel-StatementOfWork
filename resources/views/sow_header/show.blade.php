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
                        Show SOW Header
                        <div class=page-title-subheading>
                        {{ Breadcrumbs::render('header_sow.show',$ptype,$sow) }}
                        </div>
                    </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a class="btn btn-primary" href="{{ route('sow_header') }}">
                        Back
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

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">
        <p>
            <?php echo $sow->content; ?>
        </p>

        </div>

    </div>

</div>



@endsection