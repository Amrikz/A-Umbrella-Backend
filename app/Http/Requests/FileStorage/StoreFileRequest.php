<?php

namespace App\Http\Requests\FileStorage;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'files'     => ['required', 'array'],
            'files.*'   => ['file', 'max:10000', 'mimes:png,jpg,jpeg,svg,webm']
        ];
    }
}
