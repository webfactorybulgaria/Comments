<?php

namespace TypiCMS\Modules\Comments\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Comments\Http\Requests\FormRequest;
use TypiCMS\Modules\Comments\Models\Comment;
use TypiCMS\Modules\Reasons\Models\Restriction;
use TypiCMS\Modules\Comments\Repositories\CommentInterface;
use Users;
use Request;

class AdminController extends BaseAdminController
{
    public function __construct(CommentInterface $comment)
    {
        parent::__construct($comment);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all(['restrictions'], true);

        $users = Users::make()->get()->pluck('email', 'id');

        foreach ($models as $key => $value) {
            if(!empty($value->commentable_type)) {
                $itemModel = new $value->commentable_type;
                $value->editUrl = $itemModel->find($value->commentable_id)->editUrl();
                if(!empty($users[$value->user_id])) {
                    $value->user_id = $users[$value->user_id];
                } else if(!empty($value->guestname)) {
                    $value->user_id = $value->guestname . ' (guest)';
                } else {
                    $value->user_id = trans('db.inactive_user');
                }
            }

            $value->restriction = count($value->restrictions) ? 'Deleted' : 'Active';
        }

        app('JavaScript')->put('models', $models);

        return view('comments::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('comments::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Comments\Models\Comment $comment
     *
     * @return \Illuminate\View\View
     */
    public function edit(Comment $comment)
    {
        if( $deleted = $comment->restrictions->first() ) {
            $comment->reason_id = $deleted->reason_id;
        }

        return view('comments::admin.edit')
            ->with(['model' => $comment]);
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
        $comment = $this->repository->create($request->all());

        return $this->redirect($request, $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Comments\Models\Comment            $comment
     * @param \TypiCMS\Modules\Comments\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Comment $comment)
    {
        $comment->addRestriction();

        return redirect(Request::input('return'));
    }
}
