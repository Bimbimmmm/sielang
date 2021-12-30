<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeetingRoom;
use App\Models\MeetingRoomAttendance;
use App\Models\MeetingRoomAttendanceDetail;

class StudentClassMeetingRoomController extends Controller
{
  public function show($id, $idc)
  {
      $user_id = auth()->user()->id;
      $data=MeetingRoom::where('id', $id)->first();
      $attendance=MeetingRoomAttendance::where('meeting_room_id', $id)->first();
      $check=MeetingRoomAttendanceDetail::where(['meeting_room_attendance_id' => $attendance->id, 'user_id' => $user_id, 'is_attend' => TRUE])->count();
      return view('student/class/meetingroom/show', compact('id', 'idc', 'data', 'check'));
  }
}
