<h3>@lang('db.Comments')</h3>
@if($model->comments->count())
	@foreach ($model->comments as $comment)
	<div class="comment">
		<h4 class="comment-user">
	    @if($comment->user)
	    	{{ $comment->user->first_name }} {{ $comment->user->last_name }}
	    @else
	    	{!! $comment->present()->guestname ?: trans('db.inactive_user') !!}
	    @endif
	    </h4>
        <p>{{ $comment->created_at }}</p>
	    {!! $comment->present()->comment !!}
	</div>
	@endforeach
@else
	@lang('db.No comments')
@endif

@include('comments::public._form')
