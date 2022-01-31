<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Provinces;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Villages;
use App\Models\Roles;
use App\Models\ReferenceRanks;
use App\Models\ReferenceReligions;
use App\Models\TeacherPersonalData;
use App\Models\StudentPersonalData;
use Validator;
use Alert;

class OperatorUserController extends Controller
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
          $datas=User::where(['school_id' => $school_id, 'role_id' => $role->id, 'is_verified' => TRUE, 'is_deleted' => FALSE])->get();
          return view('operator/user/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $provinces=Provinces::all();
      $religions=ReferenceReligions::all();
      return view('operator/user/create', compact('provinces', 'religions'));
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
          'name'                  => 'required',
          'id_number'             => 'required',
          'student_number'        => 'required',
          'national_student_number' => 'required',
          'birth_place'           => 'required',
          'birth_date'            => 'required',
          'gender'                => 'required',
          'religion_id'           => 'required',
          'email'                 => 'required|email|unique:users,email',
          'password'              => 'required|confirmed|min:8',
          'address'               => 'required',
          'zip_code'              => 'required',
          'province'              => 'required',
          'city'                  => 'required',
          'district'              => 'required',
          'village'               => 'required'
      ];

      $messages = [
          'name.required'                     => 'Nama Wajib Diisi',
          'student_number.required'           => 'NIS wajib diisi',
          'id_number.required'                => 'NIK Wajib Diisi',
          'national_student_number.required'  => 'NISN Wajib Diisi',
          'birth_place.required'              => 'Tempat Lahir Wajib Diisi',
          'birth_date.required'               => 'Tanggal Lahir Wajib Diisi',
          'gender.required'                   => 'Jenis Kelamin Wajib Diisi',
          'religion_id.required'              => 'Agama Wajib Diisi',
          'email.required'                    => 'Email Wajib Diisi',
          'email.email'                       => 'Email Tidak Valid',
          'email.unique'                      => 'Email Sudah Terdaftar',
          'password.required'                 => 'Password Wajib Diisi',
          'password.confirmed'                => 'Password Tidak Sama Dengan Konfirmasi Password',
          'password.min'                      => 'Password Minimal 8 Karakter',
          'zip_code.required'                 => 'Kode POS wajib diisi',
          'address.required'                  => 'Alamat wajib diisi',
          'province.required'                 => 'Provinsi wajib diisi',
          'city.required'                     => 'Kota wajib diisi',
          'district.required'                 => 'Kecamatan wajib diisi',
          'village.required'                  => 'Kelurahan / Desa wajib diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $operator = auth()->user()->school_id;
      $role=Roles::where('name', 'Pelajar')->first();

      $birth_date = date("Y-m-d", strtotime($request->birth_date));

      $get_province = Provinces::where('code', $request->province)->first();
      $get_city = Cities::where('code', $request->city)->first();
      $get_district = Districts::where('code', $request->district)->first();
      $get_village = Villages::where('code', $request->village)->first();

      $data = new StudentPersonalData;
      $data->name = $request->name;
      $data->student_number = $request->student_number;
      $data->id_number = $request->id_number;
      $data->national_student_number = $request->national_student_number;
      $data->birth_place = $request->birth_place;
      $data->birth_date = $birth_date;
      $data->gender = $request->gender;
      $data->religion_id = $request->religion_id;
      $data->school_id = $operator;
      $data->address = $request->address;
      $data->zip_code = $request->zip_code;
      $data->province = $get_province->name;
      $data->city = $get_city->name;
      $data->district = $get_district->name;
      $data->village = $get_village->name;
      $save = $data->save();

      $get=StudentPersonalData::where(['national_student_number' => $request->national_student_number, 'id_number' => $request->id_number])->first();

      $user = new User;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->student_personal_data_id = $get->id;
      $user->role_id = $role->id;
      $user->school_id = $operator;
      $user->is_deleted = FALSE;
      $save2 = $user->save();

      if($save2){
          Alert::success('Berhasil', 'Akun Siswa Berhasil Dibuat');
          return redirect()->route('operatoruserindex');
      } else {
          Alert::error('Gagal', 'Gagal Membuat Akun Siswa! Silahkan ulangi beberapa saat lagi');
          return redirect()->route('operatorusercreate');
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
        return view('operator/user/show');
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
