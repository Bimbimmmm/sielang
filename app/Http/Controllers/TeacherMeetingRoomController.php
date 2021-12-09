<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentEnrolled;
use App\Models\MeetingRoom;
use App\Models\MeetingRoomAttendance;
use App\Models\MeetingRoomAttendanceDetail;
use Validator;
use Alert;


class TeacherMeetingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      return view('teacher/teaching/meetingroom/create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $rules = [
            'name'           => 'required',
            'start_date'     => 'required',
            'expired_date'   => 'required',
            'meeting_media'  => 'required',
            'file'           => 'required',
            'file.*'         => 'mimes:pdf|max:2048'
        ];

        $messages = [
            'name.required'               => 'Nama Wajib Diisi',
            'start_date.required'         => 'Tanggal Mulai Kelas wajib diisi',
            'expired_date.unique'         => 'Tanggal Kadaluarsa Kelas Wajib Diisi',
            'meeting_media.required'      => 'Media Pertemuan Wajib Diisi',
            'file.required'               => 'File Wajib Diupload',
            'file.mimes'                  => 'File Wajib Berekstensi .pdf dan Maksmial 2MB'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $start_date = date("Y-m-d", strtotime($request->start_date));
        $expired_date = date("Y-m-d", strtotime($request->expired_date));

        $original_name = $request->file->getClientOriginalName();
        $file = 'file_materi_pertemuan_' . time() . '_' . $original_name;
        $request->file->move(public_path('storage/meetingroom'), $file);

        $data = new MeetingRoom;
        $data->name = $request->name;
        $data->teaching_hour_id = $id;
        $data->start_date = $start_date;
        $data->expired_date = $expired_date;
        $data->meeting_media = $request->meeting_media;
        $data->link = $request->link;
        $data->subject_material_link = $request->subject_material_link;
        $data->file = $file;
        $data->is_active = TRUE;
        $data->is_deleted = FALSE;
        $save = $data->save();

        $get=MeetingRoom::where(['name' => $request->name, 'teaching_hour_id' => $id])->first();

        $name='Absensi_' . $request->name;

        $data2 = new MeetingRoomAttendance;
        $data2->name = $name;
        $data2->meeting_room_id = $get->id;
        $data2->is_deleted = FALSE;
        $save2 = $data2->save();

        $get2=MeetingRoomAttendance::where(['name' => $name, 'meeting_room_id' => $get->id])->first();

        $enrolls=StudentEnrolled::where(['teaching_hour_id' => $id, 'is_deleted' => FALSE])->get();

        foreach($enrolls as $enroll){
          $data3 = new MeetingRoomAttendanceDetail;
          $data3->meeting_room_attendance_id = $get2->id;
          $data3->user_id = $enroll->user_id;
          $data3->is_deleted = FALSE;
          $save3 = $data3->save();
        }

        Alert::success('Berhasil', 'Ruang Pertemuan Berhasil Dibuat');
        return redirect()->route('teacherteachingshow', array($id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('teacher/teaching/meetingroom/show', compact('id'));
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
