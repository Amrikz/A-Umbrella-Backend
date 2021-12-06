<?php

namespace App\Http\Resources\Homeworks;

use App\Http\Resources\Users\UserProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SolutionInHomeworkResource extends JsonResource
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
            'owner'         => new UserProfileResource($this->owner),
            'files'         => $this->files,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
