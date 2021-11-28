<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeachingHour;
use App\Models\StudentEnrolled;
use Validator;
use Alert;

class StudentClassListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_id = auth()->user()->school_id;
        $datas=TeachingHour::where(['school_id' => $school_id, 'is_active' => TRUE, 'is_deleted' => FALSE])->get();
        return view('student/classlist/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function enrolled($id)
    {
        $user_id = auth()->user()->id;
        $check=StudentEnrolled::where(['teaching_hour_id' => $id, 'user_id' => $user_id])->count();
        if($check > 0){
          Alert::error('Gagal', 'Sudah Terdaftar Sebelumnya, Buka Halaman Kelas Saya!');
          return redirect()->back();
        }else{
          $data = new StudentEnrolled;
          $data->teaching_hour_id = $id;
          $data->user_id = $user_id;
          $data->is_active = TRUE;
          $data->is_deleted = FALSE;
          $save = $data->save();

          if($save){
              Alert::success('Berhasil', 'Kelas Berhasil Didaftari');
              return redirect()->route('studentclass');
          } else {
              Alert::error('Gagal', 'Gagal Mendaftar Pada Kelas! Silahkan ulangi beberapa saat lagi');
              return redirect()->back();
          }
        }
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
