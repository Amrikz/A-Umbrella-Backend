<?php

namespace App\Http\Requests\WeekDay;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeekDayRequest extends FormRequest
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
            'name'      => ['string', 'max:255'],
            'number'    => ['numeric', 'between:1,7'],
        ];
    }
}
