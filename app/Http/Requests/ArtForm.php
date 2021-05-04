<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>'required',
            'desc'=>'required',
            'genre'=>'required',
            'age_restriction'=>'required',
            'cost'=>'required',
            'file'=>'required',
            'artist'=>'required',
            'lead_college'=>'required',
            'tag.*'=>'required',
            'cpy'=>'',
            'credits'=>'',
        ];
    }
}
