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

class TeacherStudentScoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $datas=TeachingHour::where(['user_id' => $user_id, 'is_active' => FALSE, 'is_deleted' => FALSE])->get();
        return view('teacher/score/index', compact('datas'));
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
      $students=StudentEnrolled::where(['teaching_hour_id' => $data->id, 'is_active' => TRUE, 'is_deleted' => FALSE])->get();
      $att=[];
      $a=0;

      $meeting_rooms=MeetingRoom::where(['teaching_hour_id' => $data->id, 'is_deleted' => FALSE])->get();
      foreach ($meeting_rooms as $meeting_room) {
        $mr_attendances=MeetingRoomAttendance::where(['meeting_room_id' => $meeting_room->id, 'is_deleted' => FALSE])->get();
        foreach ($mr_attendances as $mr_attendance) {
          $mr_att_details=MeetingRoomAttendanceDetail::where(['meeting_room_attendance_id' => $mr_attendance->id, 'is_deleted' => FALSE])->get();
          foreach ($mr_att_details as $mr_att_detail) {
            foreach ($students as $student) {
              $attend=MeetingRoomAttendanceDetail::where(['id' => $mr_att_detail->id, 'user_id' => $student->user_id, 'is_deleted' => FALSE])->first();
              if($attend != NULL){
                $att[$a]=$attend;
                $a=$a+1;
              }
            }
          }
        }
      }
      return view('teacher/score/show', compact('data', 'students', 'att'));
    }

}
