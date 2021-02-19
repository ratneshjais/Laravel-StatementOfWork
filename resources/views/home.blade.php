@extends('layouts.app')

    

@section('content')
    @if(Auth::check())
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon title-clipboard-icon">
                    <i class="pe-7s-home"></i>
                </div>
                <div>Home
                    <div class="page-title-subheading">
                        {{ Breadcrumbs::render('home') }}
                    </div>
                </div>
            </div>

            <div class="page-title-actions">

            </div>
        </div>
    </div>
        @if(Auth::user()->getRoleNames()->first() != 'super-admin')
            @include('layouts.search_bar')
            @foreach($all_sow as $key => $sow)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-card card">
                        <div class="card-header">
                            @if($key == 'inprogress'){{'In Progress Statement Of work'}}
                            @elseif($key == 'draft'){{'Draft Statement Of work'}}
                            @elseif($key == 'approved'){{'Approved Statement Of work'}}
                            @elseif($key == 'rejected'){{'Rejected Statement Of work'}}
                            @elseif($key == 'approver'){{'Approvers Dashboard All Statement Of work'}}
                            @elseif($key == 'reviewer'){{'Reviewers Dashboard All Statement Of work'}}
                            @endif
                        </div>
                            <div class="card-body">
                                <table class="mb-0 table table-striped" >
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Party</th>
                                        <th>Status</th>
                                        <th> Action</th>
                                    </tr>
                                    <?php $i=0;?>
                                    @if(count($sow) > 0)    
                                        @foreach ($sow as $sows)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $sows->project_name }}</td>
                                                <td>{{ $sows->sow_code }}</td>
                                                <td>{{ $sows->project_type->type }}</td>
                                                <td>{{ $sows->procuring_party->name }}</td>
                                                <td>{{ trans('status.'.$sows->status) }}</td>
                                                <td>

                                                    <?php $sow_show = '' ?>

                                                    @if($key =='draft')         
                                                    <a class="btn btn-primary" href="{{ route('sowEdit',['filter'=>$key, 'id'=> $sows->id, 'step'=> 1]) }}">Edit</a>         
                                                    @elseif ($key =='rejected')  
                                                        <a class="btn btn-primary" href="{{ route('sowEdit',['filter'=>$key, 'id'=> $sows->id, 'step'=> 1]) }}">Re-submit</a>                                    
                                                        <a class="btn btn-info" href="{{route('sowView',['filter'=>$key, 'id'=> $sows->id])}}" title="Show"><i class="fa fa-eye"></i></a>
                                                    @elseif ($key =='approver')
                                                        <a class="btn btn-info" href="{{ route('sows_action',['filter'=>$key, 'id'=> $sows->id]) }}">Approve</a>  
                                                        <a class="btn btn-info" href="{{route('sowView',['filter'=>$key, 'id'=> $sows->id])}}" title="Show"><i class="fa fa-eye"></i></a>
                                                    @elseif ($key =='reviewer')
                                                        <a class="btn btn-info" href="{{ route('sows_action',['filter'=>$key, 'id'=> $sows->id]) }}">Review</a>
                                                        <a class="btn btn-info" href="{{route('sowView',['filter'=>$key, 'id'=> $sows->id])}}" title="Show"><i class="fa fa-eye"></i></a>
                                                    @else
                                                    <a class="btn btn-info" href="{{route('sowView',['filter'=>$key, 'id'=> $sows->id])}}" title="Show"><i class="fa fa-eye"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center"> No data found</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="mb-5">
                            @if(sizeof($sow) > 1)
                                <div class="pull-right">
                                    <a href="{{ route('sowslist', ['filter' => $key]) }}">More...</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else   
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Admin Dashboard</div>
                        <div class="card-body">
                            {{'Login Successfully'}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">{{ __('Logout') }}</div>
                    <div class="card-body">
                        {{'Logout Successfully'}}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
