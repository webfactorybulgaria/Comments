# Comments

Frontend-> comments can be added to models with the commentable trait(ex. news, events, articles, tours etc.)
You can select from Local, Disquss and Facebook comments

# Disquss:
You have to set your short_name in the config. (make sure you copy the whole disquss section from the comments array)
If you want to show the number of comments on the listing you need to:
1. Add a span like this <span class="disqus-comment-count" data-disqus-url="URL TO THE SHOW PAGE"></span>
2. Add this to the bottom of the list: <script id="dsq-count-scr" src="//test-fzgboletzf.disqus.com/count.js" async></script>
(more info: https://help.disqus.com/customer/portal/articles/565624)


#Facebook:
If you want to moderate the comments in facebook you have to add this at the top of your show.blade 
@section('meta_tags')
{!! Comments::getMetaTags() !!}
@endsection

Backend-> comments are managed through the backoffice Comments tab


This module is part of [Admintool4](https://github.com/webfactorybulgaria/Base), a multilingual CMS based on Laravel 5.
