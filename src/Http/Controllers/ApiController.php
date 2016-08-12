<?php

namespace TypiCMS\Modules\Comments\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Comments\Models\Comment;
use TypiCMS\Modules\Comments\Repositories\CommentInterface as Repository;

class ApiController extends BaseApiController
{

    /**
     *  Array of endpoints that do not require authorization
     *
     */
    protected $publicEndpoints = [];

    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }

    protected function transform($models)
    {
        foreach($models as $key => $model) {
            $models[$key]->commentable->uri = url($models[$key]->commentable->uri());
            $models[$key]->commentable->editUrl = url($models[$key]->commentable->editUrl());
            $models[$key]->createdDiff = $models[$key]->present()->createdDiff;
            $models[$key]->userName = $models[$key]->present()->userName;
            $models[$key]->commentStatus = $models[$key]->status; // no idea why the status field is being overwritten in angular
        }
        return $models;
    }

    public function index($builder = null)
    {
        $builder = $this->repository->getModel()->with(['commentable', 'user'])->latest();
 
        return parent::index($builder);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $model = $this->repository->create(Request::all());
        $error = $model ? false : true;

        return response()->json([
            'error' => $error,
            'model' => $model,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $updated = $this->repository->update(Request::all());

        return response()->json([
            'error' => !$updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \TypiCMS\Modules\Comments\Models\Comment $comment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $deleted = $this->repository->delete($comment);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
