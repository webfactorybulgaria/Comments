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
}
