{!! BootForm::open()->action(route('public::store-comment'))->role('form') !!}
	{!! BootForm::hidden('id') !!}
	{!! BootForm::hidden('return')->value(Request::url()) !!}
	{!! BootForm::hidden('model')->value(Crypt::encrypt(get_class($model) . '.' . $model->getKey())) !!}
    @if (!auth()->user())
	   {!! BootForm::text(trans('db.guestname'), 'guestname') !!}
    @endif
    {!! BootForm::textarea(trans('db.comment'), 'comment')->rows(4) !!}
    <button class="btn-default btn" type="submit">@lang('db.comment_send')</button>
{!! BootForm::close() !!}
