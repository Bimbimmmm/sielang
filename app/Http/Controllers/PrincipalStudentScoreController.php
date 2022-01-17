<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeachingHour;
use App\Models\ClassTask;
use App\Models\ClassTaskCollection;
use App\Models\ClassQuiz;
use App\Models\ClassQuizCollection;
use App\Models\ClassExam;
use App\Models\ClassExamCollection;
use App\Models\MeetingRoom;
use App\Models\MeetingRoomAttendance;
use App\Models\MeetingRoomAttendanceDetail;
use App\Models\StudentEnrolled;
use App\Models\LessonResult;
use App\Models\LessonResultDetail;

class PrincipalStudentScoreController extends Controller
{
  public function index()
  {
    $school_id = auth()->user()->school_id;
    $datas=TeachingHour::where(['school_id' => $school_id, 'is_active' => FALSE, 'is_deleted' => FALSE])->get();
    return view('principal/score/index', compact('datas'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $data=TeachingHour::where('id', $id)->first();
    $check=LessonResult::where(['teaching_hour_id' => $id, 'is_deleted' => FALSE])->count();
    $students=StudentEnrolled::where(['teaching_hour_id' => $data->id, 'is_active' => TRUE, 'is_deleted' => FALSE])->get();

    return view('principal/score/show', compact('data', 'students', 'check'));
  }

  public function showstudent($id, $idss)
  {
    $attendance_score=0;
    $att_score=0;
    $task_score=0;
    $quiz_score=0;
    $exam_score=0;
    $total_task_score=0;
    $total_quiz_score=0;
    $total_exam_score=0;
    $student=StudentEnrolled::where('id', $id)->first();

    $get_mrs=MeetingRoom::where(['teaching_hour_id' => $student->teaching_hour_id, 'is_deleted' => FALSE])->get();
    foreach ($get_mrs as $get_mr) {
      $mrs=MeetingRoomAttendance::where(['meeting_room_id' => $get_mr->id, 'is_deleted' => FALSE])->get();
      foreach ($mrs as $mr) {
        $mrds=MeetingRoomAttendanceDetail::where(['meeting_room_attendance_id' => $mr->id, 'user_id' => $student->user_id, 'is_deleted' => FALSE])->get();
        $mrcount=$mrds->count();
        foreach ($mrds as $mrd) {
          if($mrd->is_attend == TRUE){
            $att_score=$att_score+1;
          }
        }
      }
    }

    $get_tasks=ClassTask::where(['teaching_hour_id' => $student->teaching_hour_id, 'is_deleted' => FALSE])->get();
    foreach ($get_tasks as $get_task) {
      $tasks=ClassTaskCollection::where(['meeting_task_id' => $get_task->id, 'user_id' => $student->user_id, 'is_scored' => TRUE, 'is_deleted' => FALSE])->get();
      $task_count=$tasks->count();
      foreach ($tasks as $task) {
        $task_score=$task_score+$task->score;
      }
    }

    $get_quizs=ClassQuiz::where(['teaching_hour_id' => $student->teaching_hour_id, 'is_deleted' => FALSE])->get();
    foreach ($get_quizs as $get_quiz) {
      $quizs=ClassQuizCollection::where(['meeting_quiz_id' => $get_quiz->id, 'user_id' => $student->user_id, 'is_scored' => TRUE, 'is_deleted' => FALSE])->get();
      $quiz_count=$quizs->count();
      foreach ($quizs as $quiz) {
        $quiz_score=$quiz_score+$quiz->total_score;
      }
    }

    $get_exams=ClassExam::where(['teaching_hour_id' => $student->teaching_hour_id, 'is_deleted' => FALSE])->get();
    foreach ($get_exams as $get_exam) {
      $exams=ClassExamCollection::where(['meeting_exam_id' => $get_exam->id, 'user_id' => $student->user_id, 'is_scored' => TRUE, 'is_deleted' => FALSE])->get();
      $exam_count=$exams->count();
      foreach ($exams as $exam) {
        $exam_score=$exam_score+$exam->total_score;
      }
    }

    $attendance_score=$att_score/$mrcount*100;
    $total_task_score=$task_score/$task_count;
    $total_quiz_score=$quiz_score/$quiz_count;
    $total_exam_score=$exam_score/$exam_count;

    return view('principal/score/showstudent', compact(
      'student', 'tasks', 'quizs',
      'exams', 'total_task_score',
      'total_quiz_score', 'total_exam_score', 'idss', 'attendance_score'
    ));
  }

  public function print($id)
  {
    $data=LessonResult::where('teaching_hour_id', $id)->first();
    $details=LessonResultDetail::where('lesson_result_id', $data->id)->get();
    return view('principal/score/print', compact('data', 'details'));
  }
}