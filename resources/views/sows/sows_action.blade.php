@extends('layouts.app')

@section('content')


    <!-- @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
           @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
           @endforeach
        </ul>
    </div>
    @endif -->

    @if($sow->type == 'sow')
        @include('sows.sow_view')
    @elseif($sow->type == 'amendment')
        @include('sows.amendment_view')
    @endif
    <hr>
    @include('comments.comment_box')
    <hr>
    
    @include('comments.all_comments')
    
@endsection