<?php

namespace App\Http\Resources\Schedule;

use App\Http\Resources\Lessons\LessonResource;
use App\Http\Resources\WeekDay\WeekDayResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'time'          => $this->time,
            'week_day'      => new WeekDayResource($this->week_day),
            'lesson'        => new LessonResource($this->lesson),
            'lesson_type'   => $this->lesson_type,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
