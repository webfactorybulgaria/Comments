<?php

namespace TypiCMS\Modules\Comments\Http\Controllers;

use TypiCMS\Modules\Core\Shells\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Comments\Shells\Http\Requests\FormRequest;
use TypiCMS\Modules\Comments\Shells\Models\Comment;
use TypiCMS\Modules\Comments\Shells\Repositories\CommentInterface;
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

        return view('comments::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //no create for admin comments
        return redirect(route('admin::index-comments'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Comments\Shells\Models\Comment $comment
     *
     * @return \Illuminate\View\View
     */
    public function edit(Comment $comment)
    {
        // if( $deleted = $comment->restrictions->first() ) {
        //     $comment->reason_id = $deleted->reason_id;
        // }

        return view('comments::admin.edit')
            ->with(['model' => $comment]);
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
        $comment = $this->repository->create($request->all());

        return $this->redirect($request, $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Comments\Shells\Models\Comment            $comment
     * @param \TypiCMS\Modules\Comments\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Comment $comment)
    {
        //$comment->addRestriction();

        return redirect(Request::input('return'));
    }
}
