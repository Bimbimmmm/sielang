<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentPersonalData;
use App\Models\StudentPersonalData;
use App\Models\LessonResultDetail;
use App\Models\User;
use App\Models\ClassExamCollection;
use App\Models\ClassQuizCollection;
use App\Models\ClassTaskCollection;
use Alert;

class ParentResultDataController extends Controller
{
  public function index(){
    $att_stat=0;
    $task_stat;
    $quiz_stat;
    $exam_stat;
    $res_att=0;
    $res_task=0;
    $res_quiz=0;
    $res_exam=0;
    $ppd_id = auth()->user()->parent_personal_data_id;
    $ppd=ParentPersonalData::where('id', $ppd_id)->first();
    $data=StudentPersonalData::where('id', $ppd->student_personal_data_id)->first();
    $user=User::where('student_personal_data_id', $data->id)->first();
    $tasks=ClassTaskCollection::where(['user_id' => $user->id, 'is_scored' => TRUE])->get();
    $quizs=ClassQuizCollection::where(['user_id' => $user->id, 'is_scored' => TRUE])->get();
    $exams=ClassExamCollection::where(['user_id' => $user->id, 'is_scored' => TRUE])->get();
    $results=LessonResultDetail::where('user_id', $user->id)->get();
    $count=LessonResultDetail::where('user_id', $user->id)->count();
    foreach ($results as $result) {
      $res_att=$result->attendance+$res_att;
      $res_task=$result->task+$res_task;
      $res_quiz=$result->quiz+$res_quiz;
      $res_exam=$result->exam+$res_exam;
    }
    $att_stat=$res_att/$count;
    $task_stat=$res_task/$count;
    $quiz_stat=$res_quiz/$count;
    $exam_stat=$res_exam/$count;

    return view('parents/result/index', compact('results', 'tasks', 'quizs', 'exams', 'att_stat', 'task_stat', 'quiz_stat', 'exam_stat'));
  }
}
