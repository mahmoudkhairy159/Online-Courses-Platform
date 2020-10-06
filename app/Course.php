<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lesson;
use App\Teacher;
use App\Student;



class Course extends Model
{
    protected $fillable = [
        'name', 'level', 'status','teacher_id'
    ];

// relationship 1 to * with lessons
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
//inverse relationship 1 to * with teacher
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

//relationship * to * with student
public function students()
{
    return $this->belongsToMany(Student::class);
}




}
