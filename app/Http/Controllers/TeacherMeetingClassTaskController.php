<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeachingHour;
use App\Models\ClassTask;
use App\Models\ClassTaskCollection;
use Validator;
use Alert;

class TeacherMeetingClassTaskController extends Controller
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
          return view('teacher/teaching/task/create', compact('id'));
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
            'task_instructions'  => 'required',
            'start_date'         => 'required',
            'expired_date'       => 'required',
            'file.*'             => 'mimes:png,jpg,pdf|max:2048'
        ];

        $messages = [
            'name.required'               => 'Nama Wajib Diisi',
            'task_instructions.required'  => 'Instruksi Tugas wajib diisi',
            'start_date.required'         => 'Tanggal Mulai Tugas Wajib Diisi',
            'expired_date.required'       => 'Tanggal Expired Tugas Wajib Diisi',
            'file.mimes'                  => 'File Tugas wajib berekstensi .png atau .jpg atau .pdf'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $start_date = date("Y-m-d", strtotime($request->start_date));
        $expired_date = date("Y-m-d", strtotime($request->expired_date));

        if($request->file != null){
          $original_name = $request->file->getClientOriginalName();
          $file = 'file_lampiran_tugas' . time() . '_' . $original_name;
          $request->file->move(public_path('storage/task'), $file);
        }else{
          $file = null;
        }

        $data = new ClassTask;
        $data->name = $request->name;
        $data->teaching_hour_id = $id;
        $data->task_instructions = $request->task_instructions;
        $data->start_date = $start_date;
        $data->expired_date = $expired_date;
        $data->file = $file;
        $data->is_active = TRUE;
        $data->is_deleted = FALSE;
        $save = $data->save();

        if($save){
            Alert::success('Berhasil', 'Tugas Berhasil Dibuat');
            return redirect()->route('teacherteachingshow', $id);
        } else {
            Alert::error('Gagal', 'Gagal Membuat Tugas! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('teachertaskcreate', $id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $idt)
    {
      $data=ClassTask::where('id', $id)->first();
      $collections=ClassTaskCollection::where(['meeting_task_id' => $id, 'is_deleted' => FALSE])->get();
      return view('teacher/teaching/task/show', compact('data', 'collections', 'idt'));
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
