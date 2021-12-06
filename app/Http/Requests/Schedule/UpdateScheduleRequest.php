<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
            'time'              => ['string', 'max:255'],
            'week_day_id'       => ['numeric', 'exists:App\Models\WeekDay,id'],
            'lesson_id'         => ['nullable', 'numeric', 'exists:App\Models\Lesson,id'],
            'lesson_type_id'    => ['numeric', 'exists:App\Models\LessonType,id'],
        ];
    }
}
