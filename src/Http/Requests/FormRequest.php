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

        if(!auth()->user()) {
            $rules['guestname'] = 'required|max:255';
        }

        return $rules;
    }
}
