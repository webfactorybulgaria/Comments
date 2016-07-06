<?php

namespace TypiCMS\Modules\Comments\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Reasons\Traits\Restrictable;

class Comment extends Base
{
    use Historable;
    use PresentableTrait;
    use Restrictable;

    protected $presenter = 'TypiCMS\Modules\Comments\Presenters\ModulePresenter';

    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'commentable_id',
        'commentable_type',
        'user_id',
        'guestname',
        'resource_table',
        'comment',
        'deleted',
        'deleted_reason',
    ];

    /**
     * Comment item morph to model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Comment belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo('TypiCMS\Modules\Users\Models\User');
    }
}
