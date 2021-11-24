<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeachingHour;
use App\Models\ClassTask;
use App\Models\ClassQuiz;
use App\Models\ClassExam;
use Validator;
use Alert;

class TeacherTeachingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $datas=TeachingHour::where(['user_id' => $user_id, 'is_active' => TRUE, 'is_deleted' => FALSE])->get();
        return view('teacher/teaching/index', compact('datas'));
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
        $check=TeachingHour::where('id', $id)->count();
        $data=TeachingHour::where('id', $id)->first();
        $tasks=ClassTask::where('teaching_hour_id' , $id)->get();
        $quizs=ClassQuiz::where('teaching_hour_id' , $id)->get();
        $exams=ClassExam::where('teaching_hour_id' , $id)->get();
        if($check > 0){
          return view('teacher/teaching/show', compact('data', 'tasks', 'quizs', 'exams', 'id'));
        }else{
          Alert::error('Gagal', 'Data Tidak Ditemukan!');
          return redirect()->route('teacherteachingindex');
        }
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
