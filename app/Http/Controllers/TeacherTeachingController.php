<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeachingHour;
use App\Models\ClassTask;
use App\Models\ClassQuiz;
use App\Models\ClassExam;
use App\Models\MeetingRoom;
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
        $datas=TeachingHour::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        return view('teacher/teaching/index', compact('datas'));
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
        $meetings=MeetingRoom::where('teaching_hour_id' , $id)->get();
        $tasks=ClassTask::where('teaching_hour_id' , $id)->get();
        $quizs=ClassQuiz::where('teaching_hour_id' , $id)->get();
        $exams=ClassExam::where('teaching_hour_id' , $id)->get();
        if($check > 0){
          return view('teacher/teaching/show', compact('data', 'tasks', 'quizs', 'exams', 'id', 'meetings'));
        }else{
          Alert::error('Gagal', 'Data Tidak Ditemukan!');
          return redirect()->route('teacherteachingindex');
        }
    }

    public function inactive($id)
    {
      $data = TeachingHour::findOrFail($id);
      $data->update([
            'is_active'   => FALSE
      ]);
      $check=TeachingHour::where(['id' => $id, 'is_active' => FALSE])->count();
      if($check > 0){
        Alert::success('Berhasil', 'Kelas Telah Dinonaktifkan');
        return redirect()->route('teacherteachingindex');
      }else{
        Alert::error('Gagal', 'Kelas Tidak Dapat Dinonaktifkan');
        return redirect()->back();
      }
    }
}
