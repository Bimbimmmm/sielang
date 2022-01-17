<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentEnrolled;
use App\Models\ClassTask;
use App\Models\ClassQuiz;
use App\Models\ClassExam;
use App\Models\MeetingRoom;
use Validator;
use Alert;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_id = auth()->user()->school_id;
        $user_id = auth()->user()->id;
        $datas=StudentEnrolled::where(['user_id' => $user_id, 'is_active' => TRUE, 'is_deleted' => FALSE])->get();
        return view('student/class/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data=StudentEnrolled::where('id', $id)->first();
      $meetings=MeetingRoom::where(['teaching_hour_id' => $data->teaching_hour_id, 'is_deleted' => FALSE])->get();
      $tasks=ClassTask::where(['teaching_hour_id' => $data->teaching_hour_id, 'is_deleted' => FALSE])->get();
      $quizs=ClassQuiz::where(['teaching_hour_id' => $data->teaching_hour_id, 'is_locked' => TRUE, 'is_deleted' => FALSE])->get();
      $exams=ClassExam::where(['teaching_hour_id' => $data->teaching_hour_id, 'is_locked' => TRUE, 'is_deleted' => FALSE])->get();
      return view('student/class/show', compact('data', 'meetings', 'tasks', 'quizs', 'exams', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
