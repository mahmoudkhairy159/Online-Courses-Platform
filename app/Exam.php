<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Lesson;
use App\Question;


class Exam extends Model
{
    protected $fillable = [
        'mark','fullmark','duration','lesson_id'
    ];

    // inverse relationship 1 to 1 with Lesson
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    //relationship 1 to * with question
    public function questions(){
        return $this->hasMany(Question::class);
    }
}
