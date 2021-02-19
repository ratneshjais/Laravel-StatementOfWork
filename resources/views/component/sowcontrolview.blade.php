<div class="position-relative comments-list-dm-2  row ">
	<label for="{{ $controlName }}" class="col-sm-2  col-form-label border">{{ $controlLable }}</label>
	<div class="col-sm-10  col-form-label border NewText @if ($active) commentable @endif " @if ($active) data-comment-for="{{ $controlName }}" @endif data-new-input="{{ $controlName }}">
	    {{ $controlValue }}
	</div>
	<div class="comments-list col-sm-12 border-l-r @if(count($comments)==0) d-none @endif">
		<div class="scrolling-wrapper">
			@foreach($comments as $comment)
		        <div class="media">
		        	 <p class="pull-right"><small> {{$comment["created_at"]}} </small></p>
		        	 <div class="media-body">
						 <h4 class="media-heading user_name"> {{$comment["user"]["name"]}} </h4> 
						 <span> {{ $comment["comments"] }}</span>	        
					 </div>
				</div>		
			@endforeach
		</div>
	</div>
</div>