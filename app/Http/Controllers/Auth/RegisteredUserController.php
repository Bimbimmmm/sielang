<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TeacherPersonalData;
use App\Models\StudentPersonalData;
use App\Models\ExecutivePersonalData;
use App\Models\ParentPersonalData;
use App\Models\Roles;
use App\Models\Provinces;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Villages;
use App\Models\ReferenceMaritalStatus;
use App\Models\ReferenceEducations;
use App\Models\ReferencePositions;
use App\Models\ReferenceRanks;
use App\Models\ReferenceReligions;
use App\Models\ReferenceStatus;
use App\Models\ReferenceSchools;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
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
        return view('auth.register', compact('provinces', 'religions', 'schools', 'maritals', 'ranks', 'positions', 'statuss', 'educations'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
      //dd($request);
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required'],
        ]);

        $get_t_id=NULL;
        $get_s_id=NULL;
        $get_p_id=NULL;

        $get_province = Provinces::where('code', $request->province)->first();
        $get_city = Cities::where('code', $request->city)->first();
        $get_district = Districts::where('code', $request->district)->first();
        $get_village = Villages::where('code', $request->village)->first();

        $check=Roles::where('id', $request->role_id)->first();

        if($check->name == "Guru"){

          $request->validate([
              'name' => ['required'],
              'registration_number' => ['required', 'unique:teacher_personal_data'],
              'id_number' => ['required'],
              'educator_number' => ['required'],
              'birth_place' => ['required'],
              'birth_date' => ['required'],
              'gender' => ['required'],
              'marital_status_id' => ['required'],
              'religion_id' => ['required'],
              'rank_id' => ['required'],
              'position_id' => ['required'],
              'status_id' => ['required'],
              'school_id' => ['required'],
              'education_id' => ['required'],
              'cs_candidate_year' => ['required'],
              'cs_year' => ['required'],
              'tax_number' => ['required'],
              'teacher_type' => ['required'],
              'address' => ['required'],
              'zip_code' => ['required'],
              'province' => ['required'],
              'city' => ['required'],
              'district' => ['required'],
              'village' => ['required'],
          ]);

          $data                       = new TeacherPersonalData;
          $data->name                 = $request->name;
          $data->registration_number  = $request->registration_number;
          $data->id_number            = $request->id_number;
          $data->educator_number      = $request->educator_number;
          $data->birth_place          = $request->birth_place;
          $data->birth_date           = $request->birth_date;
          $data->gender               = $request->gender;
          $data->marital_status_id    = $request->marital_status_id;
          $data->religion_id          = $request->religion_id;
          $data->rank_id              = $request->rank_id;
          $data->position_id          = $request->position_id;
          $data->status_id            = $request->status_id;
          $data->school_id            = $request->school_id;
          $data->education_id         = $request->education_id;
          $data->cs_candidate_year    = $request->cs_candidate_year;
          $data->cs_year              = $request->cs_year;
          $data->tax_number           = $request->tax_number;
          $data->teacher_type         = $request->teacher_type;
          $data->address              = $request->address;
          $data->zip_code             = $request->zip_code;
          $data->province             = $get_province->name;
          $data->city                 = $get_city->name;
          $data->district             = $get_district->name;
          $data->village              = $get_village->name;
          $save                       = $data->save();

          $check_t_id=TeacherPersonalData::where(['name' => $request->name, 'registration_number' => $request->registration_number])->first();
          $get_t_id=$check_t_id->id;
        }else if($check->name == "Pelajar"){

          $request->validate([
              'name' => ['required'],
              'student_number' => ['required', 'unique:student_personal_data'],
              'id_number' => ['required'],
              'national_student_number' => ['required'],
              'birth_place' => ['required'],
              'birth_date' => ['required'],
              'gender' => ['required'],
              'religion_id' => ['required'],
              'school_id' => ['required'],
              'address' => ['required'],
              'zip_code' => ['required'],
              'province' => ['required'],
              'city' => ['required'],
              'district' => ['required'],
              'village' => ['required'],
          ]);

          $data                           = new StudentPersonalData;
          $data->name                     = $request->name;
          $data->student_number           = $request->student_number;
          $data->id_number                = $request->id_number;
          $data->national_student_number  = $request->national_student_number;
          $data->birth_place              = $request->birth_place;
          $data->birth_date               = $request->birth_date;
          $data->gender                   = $request->gender;
          $data->religion_id              = $request->religion_id;
          $data->school_id                = $operator;
          $data->address                  = $request->address;
          $data->zip_code                 = $request->zip_code;
          $data->province                 = $get_province->name;
          $data->city                     = $get_city->name;
          $data->district                 = $get_district->name;
          $data->village                  = $get_village->name;
          $save                           = $data->save();

          $check_s_id=StudentPersonalData::where(['name' => $request->name, 'national_student_number' => $request->national_student_number])->first();
          $get_s_id=$check_s_id->id;

        }else if($check->name == "Orang Tua"){

          $request->validate([
              'name' => ['required'],
              'id_number' => ['required', 'unique:parent_personal_data'],
              'birth_place' => ['required'],
              'birth_date' => ['required'],
              'gender' => ['required'],
              'religion_id' => ['required'],
              'address' => ['required'],
              'zip_code' => ['required'],
              'province' => ['required'],
              'city' => ['required'],
              'district' => ['required'],
              'village' => ['required'],
          ]);

          $check_student=StudentPersonalData::where('national_student_number', $request->national_student_number)->first();

          if($check_student != NULL){
            $data                             = new ParentPersonalData;
            $data->name                       = $request->name;
            $data->id_number                  = $request->id_number;
            $data->student_personal_data_id   = $check_student->id;
            $data->birth_place                = $request->birth_place;
            $data->birth_date                 = $request->birth_date;
            $data->gender                     = $request->gender;
            $data->religion_id                = $request->religion_id;
            $data->address                    = $request->address;
            $data->zip_code                   = $request->zip_code;
            $data->province                   = $get_province->name;
            $data->city                       = $get_city->name;
            $data->district                   = $get_district->name;
            $data->village                    = $get_village->name;
            $save                             = $data->save();

            $check_p_id=ParentPersonalData::where(['name' => $request->name, 'id_number' => $request->id_number])->first();
            $get_p_id=$check_p_id->id;
          }else{
            Alert::error('Gagal', 'NISN Yang Dimasukkan Tidak Terdaftar!');
            return redirect()->back();
          }
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'teacher_personal_data_id' => $get_t_id,
            'student_personal_data_id' => $get_s_id,
            'parent_personal_data_id' => $get_p_id,
            'school_id' => $request->school_id,
            'role_id' => $request->role_id,
            'is_verified' => FALSE,
            'is_deleted' => FALSE
        ]);

        event(new Registered($user));

        //Auth::login($user);
        Alert::success('Berhasil', 'Anda Sudah Terdaftar Dalam Sistem, Silahkan Menunggu Verifikasi!');
        return redirect(RouteServiceProvider::HOME);
    }
}
