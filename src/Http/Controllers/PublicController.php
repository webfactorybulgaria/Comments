<?php

namespace TypiCMS\Modules\Comments\Http\Controllers;

use TypiCMS\Modules\Core\Shells\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Comments\Shells\Repositories\CommentInterface;
use TypiCMS\Modules\Comments\Shells\Http\Requests\FormRequest;
use Crypt;
use Request;

class PublicController extends BasePublicController
{
    public function __construct(CommentInterface $comment)
    {
        parent::__construct($comment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Comments\Shells\Http\Requests\FormRequest $request
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
        $comment['ip'] = Request::ip();
        $comment['source'] = 'local';
        if (auth()->user()) {
            if (auth()->user()->isSuperUser()) {
                $comment['status'] = 'active';
            } else if (config('typicms.comments.sources.local.must_approve')) {
                $comment['status'] = 'pending';
            } else {
                $comment['status'] = 'active';
            }
        } else {
            // moderation is always required for guest comments
            $comment['status'] = 'pending';
        }

        $this->repository->create($comment);

        return redirect($request->return);
    }
}
