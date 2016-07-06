@extends('core::admin.master')

@section('title', trans('comments::global.New'))

@section('main')

    @include('core::admin._button-back', ['module' => 'comments'])
    <h1>
        @lang('comments::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-comments'))->multipart()->role('form') !!}
        @include('comments::admin._form')
    {!! BootForm::close() !!}

@endsection
