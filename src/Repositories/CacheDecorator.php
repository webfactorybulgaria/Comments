<?php

namespace TypiCMS\Modules\Comments\Repositories;

use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class CacheDecorator extends CacheAbstractDecorator implements CommentInterface
{
    public function __construct(CommentInterface $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
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
        return $this->repo->render($model);
    }

    public function getMetaTags()
    {
        return $this->repo->getMetaTags();
    }
}
