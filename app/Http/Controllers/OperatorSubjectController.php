<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Validator;
use Alert;

class OperatorSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $operator = auth()->user()->school_id;
      $datas=Subject::where(['school_id' => $operator, 'is_deleted' => FALSE])->get();
      return view('operator/subject/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operator/subject/create');
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
          'name'            => 'required',
          'is_compulsory'   => 'required'
      ];

      $messages = [
          'name.required'           => 'Nama Mata Pelajaran Wajib Diisi',
          'is_compulsory.required'  => 'Jenis Mata Pelajaran wajib diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $school_id = auth()->user()->teacherPersonalData->school_id;

      $data = new Subject;
      $data->name = $request->name;
      $data->is_compulsory = $request->is_compulsory;
      $data->school_id = $school_id;
      $data->is_deleted =FALSE;
      $save = $data->save();

      if($save){
          Alert::success('Berhasil', 'Mata Pelajaran Berhasil Dibuat');
          return redirect()->route('operatorsubjectindex');
      } else {
          Alert::error('Gagal', 'Gagal Membuat Mata Pelajaran! Silahkan ulangi beberapa saat lagi');
          return redirect()->route('operatorsubjectcreate');
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
