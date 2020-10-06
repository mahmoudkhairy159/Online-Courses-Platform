<?php

namespace App;
use App\Answer;
use App\Exam;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question', 'questionWeight','exam_id'
    ];
    //relationship 1 to * with Answer
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    //inverse relationship 1 to * with exam
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

}
