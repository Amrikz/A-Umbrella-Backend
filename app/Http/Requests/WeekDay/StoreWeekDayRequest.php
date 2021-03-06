<?php

namespace App\Http\Requests\WeekDay;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeekDayRequest extends FormRequest
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
            'name'      => ['required', 'string', 'max:255'],
            'number'    => ['required', 'numeric', 'between:1,7', 'unique:App\Models\WeekDay,number'],
        ];
    }
}
