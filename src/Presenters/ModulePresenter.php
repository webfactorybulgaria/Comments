<?php

namespace TypiCMS\Modules\Comments\Presenters;

use TypiCMS\Modules\Core\Shells\Presenters\Presenter;
use Reasons;
use Carbon\Carbon;
class ModulePresenter extends Presenter
{

    public function createdDiff()
    {
        Carbon::setLocale(config('app.locale'));
        return Carbon::parse($this->entity->created_at)->diffForHumans();
    }

    public function userName()
    {
        if ($this->entity->user) {
            return $this->entity->user->first_name . ' ' . $this->entity->user->last_name;
        } else {
            return $this->entity->guestname . ' (guest)' ?: trans('db.inactive_user');
        }

    }

    // public function comment()
    // {
    //     return $this->entity->comment;
    // }
}
