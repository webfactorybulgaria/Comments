<?php

namespace TypiCMS\Modules\Comments\Presenters;

use TypiCMS\Modules\Core\Presenters\Presenter;
use Reasons;

class ModulePresenter extends Presenter
{
    public function comment() {
        if(count($this->entity->restrictions)) {
            $msg = Reasons::make()->find($this->entity->restrictions->first()->reason_id);
            return $msg->body;
        } else {
            return $this->entity->comment;
        }
    }
}
