<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use Validator;
use Alert;

class OperatorClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operator = auth()->user()->school_id;
        $datas=ClassModel::where(['school_id' => $operator, 'is_deleted' => FALSE])->get();
        return view('operator/class/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operator/class/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = [
          'name'    => 'required',
          'major'   => 'required'
      ];

      $messages = [
          'name.required'   => 'Nama Kelas Wajib Diisi',
          'major.required'  => 'Jurusan wajib diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $school_id = auth()->user()->teacherPersonalData->school_id;

      $data = new ClassModel;
      $data->name = $request->name;
      $data->major = $request->major;
      $data->school_id = $school_id;
      $data->is_deleted =FALSE;
      $save = $data->save();

      if($save){
          Alert::success('Berhasil', 'Kelas dan Jurusan Berhasil Dibuat');
          return redirect()->route('operatorclassindex');
      } else {
          Alert::error('Gagal', 'Gagal Membuat Kelas dan Jurusan! Silahkan ulangi beberapa saat lagi');
          return redirect()->route('operatorclasscreate');
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
