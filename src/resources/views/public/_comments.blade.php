<h3>@lang('db.Comments')</h3>
@if($model->activeComments->count())
	@foreach ($model->activeComments as $comment)
	<div class="comment">
		<h4 class="comment-user">
	    	{{ $comment->present()->userName }}
            <span>- {{ $comment->present()->createdDiff }}</span>
        </h4>
	    <p style="white-space: pre-line">{{ $comment->present()->comment }}</p>
	</div>
	@endforeach
@else
	@lang('db.No comments')
@endif

@include('comments::public._form')
