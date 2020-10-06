<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\LessonResource;
use App\Lesson;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
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
        return LessonResource::collection(Lesson::all());

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
            'video'=>['required'],
            'material'=>'required',
            'assignment'=>'required',
            'course_id'=>'required'
        ];
        $validator=Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->content['status'] = 'error';
            $this->content['errors'] = $validator->errors()->all();
            return response()->json($this->content);
        }
        $lesson= new Lesson;
        $lesson->create([
            'name'=>$request->name,
            'video'=>$request->video,
            'material'=>$request->material,
            'assignment'=>$request->assignment,
            'assignmentAnswer'=>$request->assignmentAnswer,
            'course_id'=>$request->course_id,
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
        $lesson=Lesson::findOrFail($id);
        return new LessonResource($lesson);

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
            'video'=>['required'],
            'material'=>'required',
            'assignment'=>'required',
        ];
        $validator=Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $this->content['status'] = 'error';
            $this->content['errors'] = $validator->errors()->all();
            return response()->json($this->content);
        }
        $lesson= Lesson::findOrFail($id);
        $lesson->update([
            'name'=>$request->name,
            'video'=>$request->video,
            'material'=>$request->material,
            'assignment'=>$request->assignment,
            'assignmentAnswer'=>$request->assignmentAnswer,
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
        $lesson=Lesson::find($id);
        if ($lesson!=null) {
            $lesson->delete();
            $this->content['status'] = 'done';
            return response()->json($this->content);
        }else{
           $this->content['status'] = 'already deleted';
           return response()->json($this->content);
        }

    }
}
