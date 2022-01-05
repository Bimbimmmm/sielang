<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonPlan;
use App\Models\LessonPlanActivity;
use App\Models\LessonPlanAssesment;
use App\Models\LessonPlanObjective;
use App\Models\LessonPlanMedia;
use App\Models\TeachingHour;
use App\Models\Roles;
use App\Models\User;
use Validator;
use Alert;

class TeacherLessonPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $datas=LessonPlan::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        return view('teacher/plan/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user_id = auth()->user()->id;
      $datas=TeachingHour::where(['user_id' => $user_id, 'is_active' => TRUE, 'is_deleted' => FALSE])->get();
      return view('teacher/plan/create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $school_id = auth()->user()->school_id;
        $check=LessonPlan::where(['user_id' => $user_id, 'teaching_hour_id' => $request->teaching_hour_id, 'is_deleted' => FALSE])->count();
        if($check > 0){
          Alert::error('Gagal', 'RPP Sudah Ada!');
          return redirect()->back();
        }else{
          $rules = [
              'type'               => 'required',
              'teaching_hour_id'   => 'required',
              'meeting'            => 'required'
          ];

          $messages = [
              'type.required'               => 'Tipe Pembelajaran Wajib Dipilih',
              'teaching_hour_id.required'   => 'Mata Pelajaran Wajib Dipilih',
              'meeting.required'            => 'Pertemuan Wajib Dimasukkan'
          ];

          $validator = Validator::make($request->all(), $rules, $messages);

          if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          $data = new LessonPlan;
          $data->user_id = $user_id;
          $data->teaching_hour_id = $request->teaching_hour_id;
          $data->school_id = $school_id;
          $data->type = $request->type;
          $data->meeting = $request->meeting;
          $data->is_locked = FALSE;
          $data->is_accepted = FALSE;
          $data->is_deleted = FALSE;
          $save = $data->save();

          if($save){
              Alert::success('Berhasil', 'RPP Berhasil Dibuat');
              return redirect()->route('teacherlessonplanindex');
          } else {
              Alert::error('Gagal', 'Gagal Membuat RPP! Silahkan ulangi beberapa saat lagi');
              return redirect()->back();
          }
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
      $data=LessonPlan::where('id', $id)->first();
      $objectives=LessonPlanObjective::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      $medias=LessonPlanMedia::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      $activities=LessonPlanActivity::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      $assesments=LessonPlanAssesment::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      return view('teacher/plan/show', compact('id', 'data', 'objectives', 'medias', 'activities', 'assesments'));
    }

    public function lock($id)
    {
      $data = LessonPlan::findOrFail($id);
      $data->update([
            'is_locked'   => TRUE
        ]);

      $check=LessonPlan::where(['id' => $id, 'is_locked' => TRUE])->count();
      if($check > 0){
        Alert::success('Berhasil', 'RPP Berhasil Dikunci');
        return redirect()->route('teacherlessonplanindex');
      }else{
        Alert::error('Gagal', 'RPP Gagal Dibuat, Mohon Ulangi Beberapa Saat Lagi');
        return redirect()->back();
      }
    }

    public function print($id)
    {
      $school_id = auth()->user()->school_id;
      $user_id = auth()->user()->id;
      $role_id=Roles::where('name', 'Kepala Sekolah')->first();
      $data=LessonPlan::where('id', $id)->first();
      $objectives=LessonPlanObjective::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      $medias=LessonPlanMedia::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      $activities=LessonPlanActivity::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      $assesments=LessonPlanAssesment::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();

      $get_principal=User::where(['school_id' => $school_id, 'role_id' => $role_id->id])->first();
      $get_user=User::where('id', $user_id)->first();
      return view('teacher/plan/print', compact('id', 'data', 'objectives', 'medias', 'activities', 'assesments', 'get_principal', 'get_user'));
    }

}
