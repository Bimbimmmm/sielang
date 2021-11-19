<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeachingHour;
use App\Models\ClassExam;
use App\Models\ClassExamQuestion;
use App\Models\ClassExamChoice;
use Validator;
use Alert;

class TeacherMeetingClassExamController extends Controller
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
      $check=TeachingHour::where('id', $id)->count();
      if($check > 0){
        return view('teacher/teaching/exam/create', compact('id'));
      }else{
        Alert::error('Gagal', 'Data Tidak Ditemukan!');
        return redirect()->route('teacherteachingindex');
      }
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
          'name'               => 'required',
          'start_date'         => 'required',
          'expired_date'       => 'required',
          'file.*'             => 'mimes:png,jpg,pdf|max:2048'
      ];

      $messages = [
          'name.required'               => 'Nama Wajib Diisi',
          'start_date.required'         => 'Tanggal Mulai Ujian Wajib Diisi',
          'expired_date.required'       => 'Tanggal Expired Ujian Wajib Diisi',
          'file.mimes'                  => 'File Kisi-Kisi wajib berekstensi .png atau .jpg atau .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $start_date = date("Y-m-d", strtotime($request->start_date));
      $expired_date = date("Y-m-d", strtotime($request->expired_date));

      if($request->file != null){
        $original_name = $request->file->getClientOriginalName();
        $file = 'file_lampiran_kuis' . time() . '_' . $original_name;
        $request->file->move(public_path('storage/quiz'), $file);
      }else{
        $file = null;
      }

      $data = new ClassExam;
      $data->name = $request->name;
      $data->teaching_hour_id = $id;
      $data->start_date = $start_date;
      $data->expired_date = $expired_date;
      $data->file = $file;
      $data->is_locked = FALSE;
      $data->is_active = FALSE;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
          Alert::success('Berhasil', 'Ujian Berhasil Dibuat');
          return redirect()->route('teacherteachingshow', $id);
      } else {
          Alert::error('Gagal', 'Gagal Membuat Ujian! Silahkan ulangi beberapa saat lagi');
          return redirect()->route('teachertaskcreate', $id);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
