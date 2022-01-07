<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeetingRoomAttendance;
use App\Models\MeetingRoomAttendanceDetail;

class AdminAttendController extends Controller
{
  public function index()
  {
      $datas=MeetingRoomAttendance::where('is_deleted', FALSE)->get();
      return view('administrator/attendance/index', compact('datas'));
  }

  public function show($id)
  {
      $detail=MeetingRoomAttendance::where('id', $id)->first();
      $datas=MeetingRoomAttendanceDetail::where('meeting_room_attendance_id', $id)->get();
      return view('administrator/attendance/show', compact('detail', 'datas'));
  }

  public function destroy($id)
  {
    $data = MeetingRoomAttendance::findOrFail($id);
    $data->update([
          'is_deleted'   => TRUE
      ]);

    $check=MeetingRoomAttendance::where(['id' => $id, 'is_deleted' => TRUE])->count();

    if($count > 0){
      Alert::success('Berhasil', 'Absensi Berhasil Dihapus');
      return redirect()->back();
    }else{
      Alert::error('Gagal', 'Absensi Gagal Dihapus');
      return redirect()->back();
    }
  }
}
