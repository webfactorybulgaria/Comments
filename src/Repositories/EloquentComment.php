<?php

namespace TypiCMS\Modules\Comments\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentComment extends RepositoriesAbstract implements CommentInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Render a comments box.
     *
     * @param Model $model The model which comments we want
     *
     * @return string html code of a menu
     */
    public function render($model)
    {

        return view('comments::public._comments', ['model' => $model]);
    }

    public function getMetaTags()
    {
        return '';
    }
}
