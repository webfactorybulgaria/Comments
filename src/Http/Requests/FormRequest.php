<?php

namespace TypiCMS\Modules\Comments\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        $rules = [
            'comment' => 'required',
        ];

        if(!$this->user()) {
            if (config('typicms.comments.sources.local.guests_allowed')) {
                $rules['guestname'] = 'required|max:255';
            } else {

            }
        }

        return $rules;
    }

    public function authorize()
    {
        return $this->user() || config('typicms.comments.sources.local.guests_allowed');
    }
}
