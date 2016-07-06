@extends('core::admin.master')

@section('title', trans('comments::global.name'))

@section('main')

<div ng-app="typicms" ng-cloak ng-controller="ListController">

    @include('core::admin._button-create', ['module' => 'comments'])

    <h1>
        <span>@{{ models.length }} @choice('comments::global.comments', 2)</span>
    </h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table st-persist="commentsTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="created_at" class="created_at st-sort">Created</th>
                    <th st-sort="comment" class="comment st-sort">Comment</th>
                    <th st-sort="user_id" class="user_id st-sort">User</th>
                    <th st-sort="resource_table" class="resource_table st-sort">Module</th>
                    <th st-sort="restriction" class="restriction st-sort">Restriction</th>
                    <th></th>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <input st-search="comment" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="user_id" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="resource_table" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="restriction" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td typi-btn-delete action="delete(model)"></td>
                    <td>
                        @include('core::admin._button-edit', ['module' => 'comments'])
                    </td>
                    <td>@{{ model.created_at }}</td>
                    <td>@{{ model.comment }}</td>
                    <td>@{{ model.user_id }}</td>
                    <td>@{{ model.resource_table }}</td>
                    <td>@{{ model.restriction }}</td>
                    <td><a href="@{{ model.editUrl }}">Go to Article #@{{ model.commentable_id }}</a></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>

@endsection
