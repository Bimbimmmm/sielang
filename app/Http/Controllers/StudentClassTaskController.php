<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassTask;
use App\Models\ClassTaskCollection;
use Validator;
use Alert;

class StudentClassTaskController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $rules = [
            'file'       => 'required',
            'file.*'     => 'mimes:pdf|max:2048'
        ];

        $messages = [
            'file.required'    => 'FIle Wajib Diupload',
            'file.mimes'       => 'File Tugas Wajib Berekstensi .pdf dan Maksimal 2mb'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $original_name = $request->file->getClientOriginalName();
        $file = 'file_kumpul_tugas_' . time() . '_' . $original_name;
        $request->file->move(public_path('storage/task/collection'), $file);

        $user_id = auth()->user()->id;

        $data = new ClassTaskCollection;
        $data->meeting_task_id = $id;
        $data->user_id = $user_id;
        $data->file = $file;
        $data->is_scored = FALSE;
        $data->is_deleted = FALSE;
        $save = $data->save();

        if($save){
            Alert::success('Berhasil', 'Tugas Berhasil Dikumpulkan');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Gagal Mengumpulkan Tugas! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $idc)
    {
      $check=ClassTask::where(['id' => $id, 'is_active' => TRUE])->count();
      if($check > 0){
        $user_id = auth()->user()->id;
        $data=ClassTask::where('id', $id)->first();
        $collection=ClassTaskCollection::where(['user_id' => $user_id, 'meeting_task_id' => $id])->first();
        return view('student/class/task/show', compact('id', 'idc', 'data', 'collection'));
      }else{
        Alert::error('Gagal', 'Tugas Sudah Tidak Aktif!');
        return redirect()->back();
      }
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
