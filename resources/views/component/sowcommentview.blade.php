<div class="comments-list col-sm-12 border-l-r @if(count($comments)==0) d-none @endif">
	<div class="scrolling-wrapper">
		@foreach($comments as $comment)
	        <div class="media commentable-comment" data-comment-id="{{ $comment['id'] }}">
	        	 <p class="pull-right"><small> {{$comment["created_at"]}} </small></p>
	        	 <div class="media-body">
	        	 	<h4 class="media-heading user_name"> {{$comment["user"]["name"]}} </h4> {{ $comment["comments"] }}
	        	 </div>
	        </div>
	    @endforeach
    </div>
</div>
