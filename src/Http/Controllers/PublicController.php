<?php

namespace TypiCMS\Modules\Comments\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Comments\Repositories\CommentInterface;
use TypiCMS\Modules\Comments\Http\Requests\FormRequest;
use Crypt;

class PublicController extends BasePublicController
{
    public function __construct(CommentInterface $comment)
    {
        parent::__construct($comment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Comments\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $model = Crypt::decrypt($request->model);

        if (strpos($model, '.') == false) {
            throw new Exception();
        }

        list($resourceType, $resourceId) = explode('.', $model);

        if (!class_exists($resourceType)) {
            throw new Exception();
        }
        $res = new $resourceType();

        $comment['commentable_id'] = $resourceId;
        $comment['commentable_type'] = $resourceType;
        $comment['user_id'] = auth()->id();
        $comment['comment'] = $request->comment;
        if(!empty($request->guestname)) {
            $comment['guestname'] = $request->guestname;
        }
        $comment['resource_table'] = $res->getTable();

        $this->repository->create($comment);

        return redirect($request->return);
    }
}
