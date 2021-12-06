<?php

namespace App\Http\Requests\Schedule;

use App\Models\LessonType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreScheduleRequest extends FormRequest
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
            'time'              => ['required', 'string', 'max:255'],
            'week_day_id'       => ['required', 'numeric', 'exists:App\Models\WeekDay,id'],
            'lesson_id'         => ['nullable', 'numeric', 'exists:App\Models\Lesson,id'],
            'lesson_type_id'    => ['required', 'numeric', 'exists:App\Models\LessonType,id'],
        ];
    }

    protected function prepareForValidation()
    {
        try {
            if (empty($this->lesson_type_id))
                $this->merge(['lesson_type_id' => LessonType::firstwhere('slug', 'practice')->id]);
        }
        catch (\Exception $e)
        {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    }
}
