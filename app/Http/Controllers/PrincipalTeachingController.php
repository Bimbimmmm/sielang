<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\TeachingHour;
use Validator;
use Alert;

class PrincipalTeachingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_id = auth()->user()->school_id;
        $datas=TeachingHour::where('school_id', $school_id)->get();
        return view('principal/teaching/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school_id = auth()->user()->school_id;
        $role=Roles::where('name', 'Guru')->first();
        $users=User::where(['school_id' => $school_id, 'role_id' => $role->id])->get();
        $classes=ClassModel::where(['school_id' => $school_id, 'is_deleted' => FALSE])->get();
        $subjects=Subject::where(['school_id' => $school_id, 'is_deleted' => FALSE])->get();
        return view('principal/teaching/create', compact('classes', 'subjects', 'users'));
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
            'user_id'           => 'required',
            'subject_id'        => 'required',
            'class_id'          => 'required',
            'hour'              => 'required',
            'semester_period'   => 'required',
            'year'              => 'required'
        ];

        $messages = [
            'user_id.required'          => 'Nama Guru Wajib Diisi',
            'subject_id.required'       => 'Nama Pelajaran wajib diisi',
            'class_id.required'         => 'Nama Kelas wajib diisi',
            'hour.required'             => 'Jam Pelajaran Wajib Diisi',
            'semester_period.required'  => 'Periode Semester Wajib Diisi',
            'year.required'             => 'Tahun Semester Wajib Diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $school_id = auth()->user()->school_id;

        $check=TeachingHour::where(['user_id' => $request->user_id, 'subject_id' => $request->subject_id, 'class_id' => $request->class_id, 'semester_period' => $request->semester_period, 'year' => $request->year, 'is_deleted' => FALSE])->count();

        if($check == 0){
          $data = new TeachingHour;
          $data->user_id = $request->user_id;
          $data->subject_id = $request->subject_id;
          $data->class_id = $request->class_id;
          $data->school_id = $school_id;
          $data->hour = $request->hour;
          $data->semester_period = $request->semester_period;
          $data->year = $request->year;
          $data->is_deleted = FALSE;
          $data->is_active = TRUE;
          $save = $data->save();

          if($save){
              Alert::success('Berhasil', 'Mata Pelajaran Berhasil Dibuat');
              return redirect()->route('principalteachingindex');
          } else {
              Alert::error('Gagal', 'Gagal Membuat Mata Pelajaran! Silahkan ulangi beberapa saat lagi');
              return redirect()->back();
          }
        }else{
          Alert::error('Gagal', 'Pemetaan Pada Guru, Mata Pelajaran, Periode Semester Yang Dimasukkan Sudah Ada!');
          return redirect()->back();
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
