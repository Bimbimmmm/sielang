<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceSchools;
use App\Models\TeachingHour;
use App\Models\LessonResult;
use App\Models\LessonResultDetail;
use Alert;

class ExecutiveResultController extends Controller
{
  public function index(){
    $schools=ReferenceSchools::where('is_deleted', FALSE)->get();
    return view('executive/results/index', compact('schools'));
  }

  public function show($id){
    $data=ReferenceSchools::where('id', $id)->first();
    if($data != NULL){
      $teachings=TeachingHour::where(['school_id' => $id, 'is_active' => FALSE])->get();
      return view('executive/results/show', compact('data', 'teachings', 'id'));
    }else{
      Alert::error('Gagal', 'Data Sekolah Tidak Ditemukan!');
      return redirect()->back();
    }
  }

  public function showth($id, $sid){
    $att_stat=0;
    $task_stat;
    $quiz_stat;
    $exam_stat;
    $res_att=0;
    $res_task=0;
    $res_quiz=0;
    $res_exam=0;
    $data=TeachingHour::where('id', $id)->first();
    $lesson_result=LessonResult::where('teaching_hour_id', $id)->first();
    $details=LessonResultDetail::where('lesson_result_id', $lesson_result->id)->get();
    $count=LessonResultDetail::where('lesson_result_id', $lesson_result->id)->count();
    foreach ($details as $detail) {
      $res_att=$detail->attendance+$res_att;
      $res_task=$detail->task+$res_task;
      $res_quiz=$detail->quiz+$res_quiz;
      $res_exam=$detail->exam+$res_exam;
    }
    $att_stat=$res_att/$count;
    $task_stat=$res_task/$count;
    $quiz_stat=$res_quiz/$count;
    $exam_stat=$res_exam/$count;
    return view('executive/results/showth', compact('data', 'details', 'sid', 'att_stat', 'task_stat', 'quiz_stat', 'exam_stat'));
  }
}
