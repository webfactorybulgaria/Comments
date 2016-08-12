<?php

namespace TypiCMS\Modules\Comments\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;
use Navigator;

class FacebookComment extends RepositoriesAbstract implements CommentInterface
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
        return view('comments::public._comments_facebook', ['model' => $model]);
    }

    public function getMetaTags()
    {
        if($app_id = config('typicms.comments.sources.facebook.app_id')) {

            return '<meta property="fb:app_id" content="'.$app_id.'" />';
        } else if (!empty(config('typicms.comments.sources.facebook.admins'))){
            $s = '';
            foreach(config('typicms.comments.sources.facebook.admins') as $admin) {
                $s .= '<meta property="fb:admins" content="'.$admin.'"/>';
            }

            return $s;
        }

        return '';
    }

}
