@extends('layouts.app')

@section('content')


    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon title-clipboard-icon">
                   <i class="pe-7s-menu"></i>
                </div>
                <div>Statement Of Work in {{ucwords($filter)}}
                    <div class="page-title-subheading">
                    {{ Breadcrumbs::render('sowslist', $filter) }}
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
             </div>
        </div>
    </div>
@if ($message = Session::get('success'))
  <div class="alert alert-success">
    <p>{{ $message }}</p>
  </div>
@endif
<h5 class="card-title">{{ $filterHeading }}</h5>
<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table class="mb-0 table table-striped" >
                    <tr>
                       <th>No</th>
                       <th>Sow Name</th>
                       <th>ID</th>
                       <th>Project Type</th>
                       <th>Party</th>
                       <th>Document Type</th>
                       <th>Status</th>
                       <th width="280px"> Action</th>
                    </tr>

                    @if(!empty($data[0]))
                        @foreach ($data as $key => $sows)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $sows->project_name }}</td>
                                <td>{{ $sows->sow_code }}</td>
                                <td>{{ $sows->project_type->type }}</td>
                                <td>{{ $sows->procuring_party->name }}</td>
                                <td>{{ ucfirst($sows->type) }}</td>
                                <td>{{ trans('status.'.$sows->status) }}</td>
                                <td>
                                    @if($sows->creator_id == Auth::user()->id)

                                        @if($sows->status =='draft') 
                                            @if($sows->type == 'amendment')
                                            <a class="btn btn-primary" href="{{ route('amendmentEdit',['id'=> $sows->id]) }}">Edit</a>         
                                            @elseif($sows->type == 'sow')
                                            <a class="btn btn-primary" href="{{ route('sowEdit',['filter'=>$filter, 'id'=> $sows->id, 'step'=> 1]) }}">Edit</a>         
                                            @endif
                                        @elseif ($sows->status =='rejected_by_reviewer' 
                                                || $sows->status =='rejected_by_approver')  
                                            @if($sows->type == 'amendment')
                                                <a class="btn btn-primary" href="{{ route('amendmentEdit',['id'=> $sows->id]) }}">Edit</a>         
                                            @elseif($sows->type == 'sow')
                                                <a class="btn btn-primary" href="{{ route('sowEdit',['filter'=>$filter, 'id'=> $sows->id, 'step'=> 1]) }}">Edit</a>
                                            @endif
                                        @endif

                                    @elseif ($sows->workflows->count() >0 
                                            && $sows->workflows[0]->role->name == 'reviewer'  
                                            && $sows->status == 'sent_to_reviewer'  )
                                        <a class="btn btn-info" href="{{ route('sows_action',['filter'=>$filter, 'id'=> $sows->id]) }}">Review</a>                          
                                    @elseif ($sows->workflows->count() >0 
                                            && $sows->workflows[0]->role->name == 'approver'
                                            && $sows->status == 'sent_to_approver' )
                                        <a class="btn btn-info" href="{{ route('sows_action',['filter'=>$filter, 'id'=> $sows->id]) }}">Approve</a>
                                    @endif
                                    @if($sows->status !='draft')
                                    <a class="btn btn-info" href="{{ route('sowView',['filter'=>$filter, 'id'=> $sows->id]) }}" title="Show"><i class="fa fa-eye"></i></a>
                                    @endif
                                    @if($sows->creator_id == Auth::user()->id)
                                    @can('sow-revision')<a class="btn btn-info" href="{{ route('revision',['filter'=>$filter, 'id'=> $sows->id]) }}">Log</a>@endcan
                                    @endif
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

{!! $data->render() !!}


@endsection