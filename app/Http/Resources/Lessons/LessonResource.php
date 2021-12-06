<?php

namespace App\Http\Resources\Lessons;

use App\Http\Resources\Homeworks\HomeworkInLessonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'name'          => $this->name,
            'zoom_link'     => $this->zoom_link,
            'homework'      => HomeworkInLessonResource::collection($this->relevant_homework),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
