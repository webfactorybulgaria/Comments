<?php

namespace TypiCMS\Modules\Comments\Traits;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Comments\Shells\Models\Comment;

trait Commentable
{

    /**
     * Model has comments.
     */
    public function comments()
    {
        return $this->morphMany('TypiCMS\Modules\Comments\Shells\Models\Comment', 'commentable')->orderBy('created_at', 'desc');
    }
    /**
     * Model active comments.
     */
    public function activeComments()
    {
        return $this->morphMany('TypiCMS\Modules\Comments\Shells\Models\Comment', 'commentable')->where('status', 'active')->orderBy('created_at', 'desc');
    }
}
