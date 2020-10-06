<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
             'video'=>$this->video,
             'material'=>$this->material,
             'assignment'=>$this->assignment,
             'assignmentAnswer'=>$this->assignmentAnswer,
             'course_id'=>$this->course_id
        ];
    }
}
