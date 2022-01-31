<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Validator;
use Alert;

class OperatorStudentVerifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $school_id = auth()->user()->school_id;
      $role=Roles::where('name', 'Pelajar')->first();
      $datas=User::where(['school_id' => $school_id, 'role_id' => $role->id, 'is_verified' => FALSE, 'is_deleted' => FALSE])->get();
      return view('operator/studentverif/index', compact('datas'));
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
     public function verif($id)
     {
         $data = User::findOrFail($id);
         $data->update([
               'is_verified'   => TRUE
         ]);

         $check=User::where(['id' => $id, 'is_verified' => TRUE])->count();

         if($check > 0){
           Alert::success('Berhasil', 'Siswa Berhasil Diverifikasi');
           return redirect()->back();
         }else{
           Alert::error('Gagal', 'Siswa Gagal Diverifikasi');
           return redirect()->back();
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
