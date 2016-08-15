<?php

namespace TypiCMS\Modules\Comments\Repositories;

use TypiCMS\Modules\Core\Shells\Repositories\RepositoryInterface;

interface CommentInterface extends RepositoryInterface
{
    public function render($model);
    public function getMetaTags();
}
