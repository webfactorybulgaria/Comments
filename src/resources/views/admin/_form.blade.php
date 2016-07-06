@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
@endsection

{!! BootForm::hidden('id') !!}
{!! BootForm::hidden('return')->value(Request::url()) !!}

@if($model->title)
    <div class="row">
        <div class="col-sm-2">
            <strong>{{ trans('validation.attributes.'.'title') }}</strong>
        </div>
        <div class="col-sm-2">
            {{ $titleList[$model->title] }}
        </div>
        <div class='col-sm-8'></div>
    </div>
@endif

@include('comments::admin._admin-field', ['field' => 'created_at'])
@include('comments::admin._admin-field', ['field' => 'comment'])
@include('comments::admin._admin-field', ['field' => 'user_id'])
@include('comments::admin._admin-field', ['field' => 'resource_table'])
@include('comments::admin._admin-field', ['field' => 'commentable_id'])

<div class="row">
    <div class="col-sm-4">
        {!! BootForm::select(trans('validation.reason'), 'reason_id', Reasons::allForSelect())->hideLabel() !!}
    </div>
    <div class="col-sm-2">
        <input class="btn btn-primary" type="submit" value="Restrict"></input>
    </div>
    <div class="col-sm-6">
    </div>
</div>
