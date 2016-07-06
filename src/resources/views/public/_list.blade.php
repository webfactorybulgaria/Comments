<ul class="list-comments">
    @foreach ($items as $comment)
    @include('comments::public._list-item')
    @endforeach
</ul>
