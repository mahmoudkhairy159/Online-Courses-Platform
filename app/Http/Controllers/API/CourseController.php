<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CourseResource;
use App\Course;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->content = array();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CourseResource::collection(Course::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'required|string',
            'level'=>['required'],
            'teacher_id'=>'required'

        ];
        $validator=Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->content['status'] = 'error';
            $this->content['errors'] = $validator->errors()->all();
            return response()->json($this->content);
        }
        $course= new Course;
        $course->create([
            'name'=>$request->name,
            'level'=>$request->level,
            'status'=>$request->status,
            'teacher_id'=>$request->teacher_id,
        ]);
        $this->content['status'] = 'done';
        return response()->json($this->content, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course=Course::findOrFail($id);
        return new CourseResource($course);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'name'=>'required|string',
            'level'=>['required'],
        ];
        $validator=Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->content['status'] = 'error';
            $this->content['errors'] = $validator->errors()->all();
            return response()->json($this->content);
        }
        $course=  Course::findOrFail($id);
        $course->update([
            'name'=>$request->name,
            'level'=>$request->level,
            'status'=>$request->status,
        ]);
        $this->content['status'] = 'done';
        return response()->json($this->content, 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course= Course::find($id);
        if ($course!=null) {
            $course->delete();
            $this->content['status'] = 'done';
            return response()->json($this->content);
        }else{
           $this->content['status'] = 'already deleted';
           return response()->json($this->content);
        }
    }
}
