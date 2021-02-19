@extends('layouts.app')

@section('content')

@if( $sow->type == 'sow')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon title-clipboard-icon">
                    <img src="{{asset('assets/images/clipboard.png')}}" class="clipboard-icon">
                </div>
                <div>Statement Of Work
                    <div class="page-title-subheading">
                        {{Breadcrumbs::render('sowView', $filter, $sow)}}
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                @inject('fileUpload', 'App\Http\Controllers\FileUploadController')
                @if ($fileUpload->checkFileExistsForSow($sow->id))
                    <a title="Download Signed SOW" href="{{ route('get-signed-sow',$sow->id) }}" type="button" class="btn-shadow mr-3 btn btn-info">
                        <i class="fa fa-download"></i>
                    </a>
                    <a type="button"  title="Delete Signed SOW" data-placement="bottom" class="btn-shadow mr-3 btn btn-danger" data-original-title="Delete Signed SOW" href="{{ route('deleteFile', [$filter, $sow->id]) }}">
                        <i class="fa fa-trash"></i>
                    </a>
                @elseif(Auth()->user()->hasPermissionTo('sow-upload'))
                    <a type="button"  title="Upload Signed SOW" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" data-original-title="Upload Signed SOW" href="{{ route('uploaded_file.upload', [$filter, $sow->id]) }}">
                        <i class="fa fa-upload"></i>
                    </a> 
                    <a class="btn btn-primary mr-3" target="_blank" href="{{ route('geratePdfSows',$sow->id) }}">
                     Print
                    </a>
                @endif
                @if(isset($_SERVER['HTTP_REFERER'])) 
                    <a class="btn btn-primary"  href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
                     Back
                    </a>   
                @else
                <a class="btn btn-primary"  href="/home">
                     Back
                    </a> 
                    @endif
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
   
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
              <h5 class="mb-0">
                <h3>
                    @if( $sow->sow_code != '') {{$sow->sow_code}} @else Statement Of Work  @endif
                </h3>
                <div  style="float: right;flex: auto;">
                    <button class="btn btn-link pull-right">
                        <i class="fa fa-angle-down"></i>
                    </button>
                </div>
              </h5>
            </div>

            <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    @include('sows.sowViewFields')     
                </div>
            </div>
        </div>
    </div>

    <br>
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  <h5 class="mb-0">
                    <h3>
                        Annexure
                    </h3>
                    <div  style="float: right;flex: auto;">
                        <button class="btn btn-link pull-right" >
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                  </h5>
                </div>
                <div id="collapseTwo" class="collapse hide" aria-labelledby="headingTwo" data-parent="#accordion">
                  <div class="card-body">
                   @include('sows.annex_show')
                  </div>
                </div>
            </div>
        </div>
    <hr>
@endif

@if( $sow->type == 'amendment')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon title-clipboard-icon">
                    <img src="{{asset('assets/images/clipboard.png')}}" class="clipboard-icon">
                </div>
                <div>AMENDMENT TO ORIGINAL STATEMENT OF WORK
                    <div class="page-title-subheading">
                        {{Breadcrumbs::render('sowView', $filter, $sow)}}
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                @inject('fileUpload', 'App\Http\Controllers\FileUploadController')
                @if ($fileUpload->checkFileExistsForSow($sow->id))
                    <a title="Download Signed SOW" href="{{ route('get-signed-sow',$sow->id) }}" type="button" class="btn-shadow mr-3 btn btn-info">
                        <i class="fa fa-download"></i>
                    </a>
                    <a type="button"  title="Delete Signed SOW" data-placement="bottom" class="btn-shadow mr-3 btn btn-danger" data-original-title="Delete Signed SOW" href="{{ route('deleteFile', [$filter, $sow->id]) }}">
                        <i class="fa fa-trash"></i>
                    </a>
                @elseif(Auth()->user()->hasPermissionTo('sow-upload'))
                    <a type="button"  title="Upload Signed SOW" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" data-original-title="Upload Signed SOW" href="{{ route('uploaded_file.upload', [$filter, $sow->id]) }}">
                        <i class="fa fa-upload"></i>
                    </a> 
                    <a class="btn btn-primary mr-3" target="_blank" href="{{ route('geratePdfSows',$sow->id) }}">
                     Print
                    </a>
                @endif
                @if(isset($_SERVER['HTTP_REFERER'])) 
                    <a class="btn btn-primary"  href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
                     Back
                    </a>   
                @else
                <a class="btn btn-primary"  href="/home">
                     Back
                    </a> 
                    @endif
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
   
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
              <h5 class="mb-0">
                <h3>
                    @if( $sow->sow_code != '') Amendment for {{$sow->project_name}} @else AMENDMENT  @endif
                </h3>
                <div  style="float: right;flex: auto;">
                    <button class="btn btn-link pull-right">
                        <i class="fa fa-angle-down"></i>
                    </button>
                </div>
              </h5>
            </div>

            <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    @include('sows.amendmentViewFields')     
                </div>
            </div>
        </div>
    </div>
    <hr>
@endif



    @if($sow_authorizationsUserList)
        <div id="accordionAuthorization">
            <div class="card">
                <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#Authorization" aria-expanded="true" aria-controls="Authorization">
                  <h5 class="mb-0">
                    <h3>
                        Reviewers
                    </h3>
                    <div  style="float: right;flex: auto;">
                        <button class="btn btn-link pull-right" >
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                  </h5>
                </div>
                <div id="Authorization" class="collapse hide" aria-labelledby="headingTwo" data-parent="#accordionAuthorization">
                  <div class="card-body">
                    <table class="mb-0 table table-striped" >
                       <tr>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Status</th>
                       </tr>
                       @foreach ($sow_authorizationsUserList as $reviewer)
                        <tr>
                          <td>{{ $reviewer['authorization_user']['name']}}</td>
                          <td>{{ $reviewer['authorization_user']['email']}}</td>
                          <td>{{ $reviewer['status']}}</td>
                        </tr>
                       @endforeach
                  </table>
                  </div>
                </div>
            </div>
        </div>
        <hr>
    @endif

    <div id="accordion">
        <div class="card card_comments">
            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
              <h5 class="mb-0">
                <h3>
                    Comments
                </h3>
                <div  style="float: right;flex: auto;">
                    <button class="btn btn-link pull-right">
                        <i class="fa fa-angle-down"></i>
                    </button>
                </div>
              </h5>
            </div>
            <div id="collapseThree" class="collapse hide" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
              @include('comments.all_comments')
              </div>
            </div>
        </div>
    </div>
@endsection

