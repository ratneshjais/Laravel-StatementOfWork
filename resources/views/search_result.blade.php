@extends('layouts.app')

@section('breadcrumb')
    @if (Auth::check())
        {{ Breadcrumbs::render('home') }}
    @endif
@endsection

@section('content')

    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif
    @if(Auth::user()->getRoleNames()->first() != 'super-admin')        
        @include('layouts.search_bar')
    @endif
    <h5 class="card-title">Search Result</h5>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <table class="mb-0 table table-striped" >
                        <tr>
                           <th>No</th>
                           <th>Name</th>
                           <th>ID</th>
                           <th>Type</th>
                           <th>Party</th>
                           <th>Status</th>
                           <th width="280px"> Action</th>
                        </tr>

                        @if(!empty($data))
                            @foreach ($data as $key => $sow)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $sow->project_name }}</td>
                                    <td>{{ $sow->sow_code }}</td>
                                    <td>{{ $sow->project_type->type }}</td>
                                    <td>{{ $sow->procuring_party->name }}</td>
                                    <td>{{ trans('status.'.$sow->status) }}</td>
                                    <td>
                                        @if($sow->status =='draft')         
                                            <a class="btn btn-primary" href="{{ route('sowEdit',['filter'=>$sow->status, 'id'=> $sow->id, 'step'=> 1]) }}">Edit</a>         
                                        @elseif (($sow->status =='rejected_by_reviewer' 
                                                || $sow->status =='rejected_by_approver')
                                                AND Auth::user()->getRoleNames()->first() == 'creator')  
                                            <a class="btn btn-primary" href="{{ route('sowEdit',['filter'=>$sow->status, 'id'=> $sow->id, 'step'=> 1]) }}">Re-submit</a>
                                        @endif
                                        <a class="btn btn-info" href="{{ route('sowView',['filter'=>$sow->status, 'id'=> $sow->id]) }}" title="Show"><i class="fa fa-eye"></i></a>
                                        @can('sow-revision')
                                        <a class="btn btn-info" href="{{ route('revision',['filter'=>$sow->status, 'id'=> $sow->id]) }}">Log</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No data found</td>
                            </tr>
                        @endif   
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection