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
use App\Models\ReferenceMaritalStatus;
use App\Models\ReferenceEducations;
use App\Models\ReferencePositions;
use App\Models\ReferenceRanks;
use App\Models\ReferenceReligions;
use App\Models\ReferenceStatus;
use App\Models\ReferenceSchools;
use App\Models\TeacherPersonalData;
use App\Models\StudentPersonalData;
use Validator;
use Alert;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datas=User::latest()->get();
      return view('administrator/user/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $provinces=Provinces::all();
      $maritals=ReferenceMaritalStatus::all();
      $religions=ReferenceReligions::all();
      $ranks=ReferenceRanks::all();
      $positions=ReferencePositions::all();
      $statuss=ReferenceStatus::all();
      $educations=ReferenceEducations::all();
      $schools=ReferenceSchools::all();
      $roles=Roles::orderBy('name', 'ASC')->get();
      return view('administrator/user/create', compact('provinces', 'maritals', 'religions', 'ranks', 'positions', 'statuss', 'educations', 'schools', 'roles'));
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
          'registration_number'   => 'required',
          'id_number'             => 'required',
          'educator_number'       => 'required',
          'birth_place'           => 'required',
          'birth_date'            => 'required',
          'gender'                => 'required',
          'marital_status_id'     => 'required',
          'religion_id'           => 'required',
          'rank_id'               => 'required',
          'position_id'           => 'required',
          'status_id'             => 'required',
          'school_id'             => 'required',
          'education_id'          => 'required',
          'cs_candidate_year'     => 'required',
          'cs_year'               => 'required',
          'tax_number'            => 'required',
          'teacher_type'          => 'required',
          'email'                 => 'required|email|unique:users,email',
          'password'              => 'required|confirmed|min:8',
          'role_id'               => 'required',
          'address'               => 'required',
          'zip_code'              => 'required',
          'province'              => 'required',
          'city'                  => 'required',
          'district'              => 'required',
          'village'               => 'required'
      ];

      $messages = [
          'name.required'                 => 'Nama Wajib Diisi',
          'registration_number.required'  => 'NIP wajib diisi',
          'registration_number.unique'    => 'NIP Sudah Terdaftar',
          'id_number.required'            => 'NIK Wajib Diisi',
          'educator_number.required'      => 'NUPTK Wajib Diisi',
          'birth_place.required'          => 'Tempat Lahir Wajib Diisi',
          'birth_date.required'           => 'Tanggal Lahir Wajib Diisi',
          'gender.required'               => 'Jenis Kelamin Wajib Diisi',
          'marital_status_id.required'    => 'Status Pernikahan Wajib Diisi',
          'religion_id.required'          => 'Agama Wajib Diisi',
          'rank_id.required'              => 'Pangkat / Golongan Wajib Diisi',
          'position_id.required'          => 'Jabatan Wajib Diisi',
          'status_id.required'            => 'Status Kepegawaian Wajib Diisi',
          'school_id.required'            => 'Sekolah Wajib Diisi',
          'education_id.required'         => 'Pendidikan Wajib Diisi',
          'cs_candidate_year.required'    => 'Tahun CPNS Wajib Diisi',
          'cs_year.required'              => 'Tahun PNS Wajib Diisi',
          'tax_number.required'           => 'NPWP Wajib Diisi',
          'teacher_type.required'         => 'Jenis Guru Wajib Diisi',
          'email.required'                => 'Email Wajib Diisi',
          'email.email'                   => 'Email Tidak Valid',
          'email.unique'                  => 'Email Sudah Terdaftar',
          'password.required'             => 'Password Wajib Diisi',
          'password.confirmed'            => 'Password Tidak Sama Dengan Konfirmasi Password',
          'password.min'                  => 'Password Minimal 8 Karakter',
          'role_id.required'              => 'Role Wajib Diisi',
          'zip_code.required'             => 'Kode POS wajib diisi',
          'address.required'              => 'Alamat wajib diisi',
          'province.required'             => 'Provinsi wajib diisi',
          'city.required'                 => 'Kota wajib diisi',
          'district.required'             => 'Kecamatan wajib diisi',
          'village.required'              => 'Kelurahan / Desa wajib diisi',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $birth_date = date("Y-m-d", strtotime($request->birth_date));
      $cs_candidate_year = date("Y-m-d", strtotime($request->cs_candidate_year));
      $cs_year = date("Y-m-d", strtotime($request->cs_year));

      $get_province = Provinces::where('code', $request->province)->first();
      $get_city = Cities::where('code', $request->city)->first();
      $get_district = Districts::where('code', $request->district)->first();
      $get_village = Villages::where('code', $request->village)->first();

      $data = new TeacherPersonalData;
      $data->name = $request->name;
      $data->registration_number = $request->registration_number;
      $data->id_number = $request->id_number;
      $data->educator_number = $request->educator_number;
      $data->birth_place = $request->birth_place;
      $data->birth_date = $birth_date;
      $data->gender = $request->gender;
      $data->marital_status_id = $request->marital_status_id;
      $data->religion_id = $request->religion_id;
      $data->rank_id = $request->rank_id;
      $data->position_id = $request->position_id;
      $data->status_id = $request->status_id;
      $data->school_id = $request->school_id;
      $data->education_id = $request->education_id;
      $data->cs_candidate_year = $cs_candidate_year;
      $data->cs_year = $cs_year;
      $data->tax_number = $request->tax_number;
      $data->teacher_type = $request->teacher_type;
      $data->address = $request->address;
      $data->zip_code = $request->zip_code;
      $data->province = $get_province->name;
      $data->city = $get_city->name;
      $data->district = $get_district->name;
      $data->village = $get_village->name;
      $save = $data->save();

      $get=TeacherPersonalData::where(['registration_number' => $request->registration_number, 'id_number' => $request->id_number])->first();

      $user = new User;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->teacher_personal_data_id = $get->id;
      $user->role_id = $request->role_id;
      $user->school_id = $request->school_id;
      $user->is_verified = TRUE;
      $user->is_deleted = FALSE;
      $save2 = $user->save();

      if($save2){
          Alert::success('Berhasil', 'Akun Berhasil Dibuat');
          return redirect()->route('adminuserindex');
      } else {
          Alert::error('Gagal', 'Gagal Membuat Akun! Silahkan ulangi beberapa saat lagi');
          return redirect()->route('adminusercreate');
      }

      /*
      else if($check->name == "Eksekutif"){

        $request->validate([
            'name' => ['required'],
            'registration_number' => ['required', 'unique:executive_personal_data'],
            'id_number' => ['required'],
            'birth_place' => ['required'],
            'birth_date' => ['required'],
            'gender' => ['required'],
            'position' => ['required'],
            'rank_id' => ['required'],
            'address' => ['required'],
            'zip_code' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
            'district' => ['required'],
            'village' => ['required'],
        ]);

        $data                       = new ExecutivePersonalData;
        $data->name                 = $request->name;
        $data->registration_number  = $request->registration_number;
        $data->id_number            = $request->id_number;
        $data->birth_place          = $request->birth_place;
        $data->birth_date           = $birth_date;
        $data->gender               = $request->gender;
        $data->position             = $request->position;
        $data->rank_id              = $request->rank_id;
        $data->address              = $request->address;
        $data->zip_code             = $request->zip_code;
        $data->province             = $get_province->name;
        $data->city                 = $get_city->name;
        $data->district             = $get_district->name;
        $data->village              = $get_village->name;
        $save                       = $data->save();

        $check_e_id=ExecutivePersonalData::where(['name' => $request->name, 'registration_number' => $request->registration_number])->first();
        $get_e_id=$check_e_id->id;
      */
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
