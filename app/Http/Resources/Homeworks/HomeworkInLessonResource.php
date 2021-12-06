<?php

namespace App\Http\Resources\Homeworks;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeworkInLessonResource extends JsonResource
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
            'description'   => $this->description,
            'end_date'      => $this->end_date,
            'solutions'     => SolutionInHomeworkResource::collection($this->solutions),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
