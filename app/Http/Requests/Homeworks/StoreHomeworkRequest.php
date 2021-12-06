<?php

namespace App\Http\Requests\Homeworks;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomeworkRequest extends FormRequest
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
            'description'   => ['required', 'string'],
            'end_date'      => ['required', 'date'],
            'lesson_id'     => ['required', 'numeric', 'exists:App\Models\Lesson,id'],
        ];
    }
}
