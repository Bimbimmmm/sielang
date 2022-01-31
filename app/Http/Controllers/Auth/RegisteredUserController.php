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
            'teacher_name' => ['required'],
            'teacher_registration_number' => ['required', 'unique:teacher_personal_data'],
            'teacher_id_number' => ['required'],
            'teacher_educator_number' => ['required'],
            'teacher_birth_place' => ['required'],
            'teacher_birth_date' => ['required'],
            'teacher_gender' => ['required'],
            'teacher_marital_status_id' => ['required'],
            'teacher_religion_id' => ['required'],
            'teacher_rank_id' => ['required'],
            'teacher_position_id' => ['required'],
            'teacher_status_id' => ['required'],
            'teacher_school_id' => ['required'],
            'teacher_education_id' => ['required'],
            'teacher_cs_candidate_year' => ['required'],
            'teacher_cs_year' => ['required'],
            'teacher_tax_number' => ['required'],
            'teacher_teacher_type' => ['required'],
            'address' => ['required'],
            'zip_code' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
            'district' => ['required'],
            'village' => ['required'],
          ]);

          $data                       = new TeacherPersonalData;
          $data->name                 = $request->teacher_name;
          $data->registration_number  = $request->teacher_registration_number;
          $data->id_number            = $request->teacher_id_number;
          $data->educator_number      = $request->teacher_educator_number;
          $data->birth_place          = $request->teacher_birth_place;
          $data->birth_date           = $request->teacher_birth_date;
          $data->gender               = $request->teacher_gender;
          $data->marital_status_id    = $request->teacher_marital_status_id;
          $data->religion_id          = $request->teacher_religion_id;
          $data->rank_id              = $request->teacher_rank_id;
          $data->position_id          = $request->teacher_position_id;
          $data->status_id            = $request->teacher_status_id;
          $data->school_id            = $request->teacher_school_id;
          $data->education_id         = $request->teacher_education_id;
          $data->cs_candidate_year    = $request->teacher_cs_candidate_year;
          $data->cs_year              = $request->teacher_cs_year;
          $data->tax_number           = $request->teacher_tax_number;
          $data->teacher_type         = $request->teacher_teacher_type;
          $data->address              = $request->address;
          $data->zip_code             = $request->zip_code;
          $data->province             = $get_province->name;
          $data->city                 = $get_city->name;
          $data->district             = $get_district->name;
          $data->village              = $get_village->name;
          $save                       = $data->save();

          $check_t_id=TeacherPersonalData::where(['name' => $request->teacher_name, 'registration_number' => $request->teacher_registration_number])->first();
          $get_t_id=$check_t_id->id;
          $school_id = $request->teacher_school_id;
        }else if($check->name == "Pelajar"){

          $request->validate([
              'student_name' => ['required'],
              'student_number' => ['required', 'unique:student_personal_data'],
              'student_id_number' => ['required'],
              'student_national_student_number' => ['required'],
              'student_birth_place' => ['required'],
              'student_birth_date' => ['required'],
              'student_gender' => ['required'],
              'student_religion_id' => ['required'],
              'student_school_id' => ['required'],
              'address' => ['required'],
              'zip_code' => ['required'],
              'province' => ['required'],
              'city' => ['required'],
              'district' => ['required'],
              'village' => ['required'],
          ]);

          $data                           = new StudentPersonalData;
          $data->name                     = $request->student_name;
          $data->student_number           = $request->student_number;
          $data->id_number                = $request->student_id_number;
          $data->national_student_number  = $request->student_national_student_number;
          $data->birth_place              = $request->student_birth_place;
          $data->birth_date               = $request->student_birth_date;
          $data->gender                   = $request->student_gender;
          $data->religion_id              = $request->student_religion_id;
          $data->school_id                = $request->student_school_id;
          $data->address                  = $request->address;
          $data->zip_code                 = $request->zip_code;
          $data->province                 = $get_province->name;
          $data->city                     = $get_city->name;
          $data->district                 = $get_district->name;
          $data->village                  = $get_village->name;
          $save                           = $data->save();

          $check_s_id=StudentPersonalData::where(['name' => $request->student_name, 'national_student_number' => $request->student_national_student_number])->first();
          $get_s_id=$check_s_id->id;
          $school_id = $request->student_school_id;

        }else if($check->name == "Orang Tua"){

          $request->validate([
              'parent_name' => ['required'],
              'parent_birth' => ['required'],
              'parent_phone_number' => ['required'],
              'address' => ['required'],
              'zip_code' => ['required'],
              'province' => ['required'],
              'city' => ['required'],
              'district' => ['required'],
              'village' => ['required'],
          ]);

          $check_student=StudentPersonalData::where('national_student_number', $request->parent_national_student_number)->first();

          if($check_student != NULL){
            $data                             = new ParentPersonalData;
            $data->name                       = $request->parent_name;
            $data->id_number                  = $request->parent_id_number;
            $data->student_personal_data_id   = $check_student->id;
            $data->birth                      = $request->parent_birth;
            $data->phone_number               = $request->parent_phone_number;
            $data->address                    = $request->address;
            $data->zip_code                   = $request->zip_code;
            $data->province                   = $get_province->name;
            $data->city                       = $get_city->name;
            $data->district                   = $get_district->name;
            $data->village                    = $get_village->name;
            $save                             = $data->save();

            $check_p_id=ParentPersonalData::where(['name' => $request->parent_name, 'id_number' => $request->parent_id_number])->first();
            $get_p_id=$check_p_id->id;
            $school_id = $check_student->school_id;
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
            'school_id' => $school_id,
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
