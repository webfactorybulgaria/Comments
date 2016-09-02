@extends('core::admin.master')

@section('title', trans('comments::global.name'))

@section('main')
<style>
.commentrow-active {background-color: #dafeeb;}
.commentrow-pending {background-color: #ffe88f;}
.commentrow-spam {background-color: #ef9390;}
</style>
<div ng-app="typicms" ng-cloak ng-controller="ListController" ng-show="!initializing">

    @include('core::admin._button-create', ['module' => 'comments'])

    <h1>
        <span>@{{ totalModels }} @choice('comments::global.comments', 2)</span>
    </h1>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">
        <table st-persist="commentsTable" st-table="displayedModels" st-order st-sort-default="created_at" st-sort-default-reverse="true" st-pipe="callServer" st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <td colspan="6" st-items-by-page="itemsByPage" st-pagination="" st-template="/views/partials/pagination.custom.html"></td>
                </tr>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="created_at" class="created_at st-sort">Created</th>
                    <th st-sort="comment" class="comment st-sort">Comment</th>
                    <th st-sort="resource_table" class="resource_table st-sort">Module</th>
                    <th st-sort="status" class="status st-sort">Status</th>
                    <th></th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>
                        <datepicker date-format="yyyy-MM-dd" class="filter-date">
                            <input type="text" st-search="created_at.date.filter_from" class="form-control input-sm" placeholder="From date…">
                        </datepicker>
                        <datepicker date-format="yyyy-MM-dd" class="filter-date">
                            <input type="text" st-search="created_at.date.filter_to" class="form-control input-sm" placeholder="To date…">
                        </datepicker>
                    </td>

                    <td>
                        <input st-search="comment" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="resource_table" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <select class="form-control" st-input-event="change keydown" st-search="status.set">
                            <option value="active,pending"></option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="spam">Spam</option>
                        </select>
                    </td>
                </tr>
            </thead>

            <tbody ng-class="{'table-loading':isLoading}">
                <tr ng-repeat="model in displayedModels" class="commentrow-@{{model.status}}">
                    <td typi-btn-delete action="delete(model)"></td>
                    <td>
                    </td>
                    <td nowrap>@{{ model.created_at }}</td>
                    <td>
                        <a href="@{{ model.commentable.uri }}" target="_blank">@{{ model.commentable.title }}</a>
                        (<a href="@{{ model.commentable.editUrl }}">edit</a>)<br />
                        Posted by: @{{ model.userName }} - @{{ model.createdDiff }}
                        <p style="white-space: pre-line; padding:10px">@{{ model.comment }}</p>
                        <span ng-if="model.commentStatus == 'active' || model.commentStatus == 'pending'">
                            <span ng-if="model.commentStatus == 'pending'">
                                <a href="#" ng-click="model.status='active'; model.commentStatus='active'; update(model)">Activate</a> |
                            </span>
                            <a href="#" ng-click="model.status='spam'; model.commentStatus='spam'; update(model); stCtrl.pipe();">Spam</a> |
                        </span>
                        <a href="#" ng-click="delete(model, 'comment');">Delete</a>
                    </td>
                    <td>@{{ model.resource_table }}</td>
                    <td>@{{ model.commentStatus }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" st-items-by-page="itemsByPage" st-pagination="" st-template="/views/partials/pagination.custom.html"></td>
                    <td>
                        <div ng-include="'/views/partials/pagination.itemsPerPage.html'"></div>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>

@endsection
