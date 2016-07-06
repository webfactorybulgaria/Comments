<?php

namespace TypiCMS\Modules\Comments\Traits;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Comments\Models\Comment;

trait Commentable
{
    /**
     * Model has comments.
     */
    public function comments()
    {
        return $this->morphMany('TypiCMS\Modules\Comments\Models\Comment', 'commentable')->orderBy('created_at', 'desc');
    }
}