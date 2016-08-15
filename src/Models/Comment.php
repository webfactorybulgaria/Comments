<?php

namespace TypiCMS\Modules\Comments\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Shells\Models\Base;
use TypiCMS\Modules\History\Shells\Traits\Historable;

class Comment extends Base
{
    use Historable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Comments\Shells\Presenters\ModulePresenter';

    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'commentable_id',
        'commentable_type',
        'resource_table',
        'user_id',
        'guestname',
        'ip',
        'source',
        'status',
        'comment'
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
        return $this->belongsTo('TypiCMS\Modules\Users\Shells\Models\User');
    }

    /**
     * Scope a query to only include active comments.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '=', 'active');
    }
}
