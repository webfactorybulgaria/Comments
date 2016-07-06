<li>
    <a href="{{ route($lang.'.comments.slug', $comment->slug) }}" title="{{ $comment->title }}">
        {!! $comment->title !!}
        {!! $comment->present()->thumb(null, 200) !!}
    </a>
</li>
