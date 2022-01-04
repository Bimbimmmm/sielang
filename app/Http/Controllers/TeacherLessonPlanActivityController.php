<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonPlan;
use App\Models\LessonPlanActivity;
use App\Models\LessonPlanAssesment;
use App\Models\LessonPlanObjective;
use App\Models\LessonPlanMedia;
use App\Models\TeachingHour;
use Validator;
use Alert;

class TeacherLessonPlanActivityController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
      return view('teacher/plan/activity/create', compact('id'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $id)
  {
      $rules = [
          'activity' => 'required',
          'type' => 'required'
      ];

      $messages = [
          'activity.required'  => 'Kegiatan Pembelajaran Wajib Diisi',
          'type.required'      => 'Tipe Wajib Dipilih'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $data = new LessonPlanActivity;
      $data->lesson_plan_id = $id;
      $data->type = $request->type;
      $data->activity = $request->activity;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
          Alert::success('Berhasil', 'Kegiatan Berhasil Ditambahkan');
          return redirect()->route('teacherlessonplanshow', $id);
      } else {
          Alert::error('Gagal', 'Gagal Menambahkan Kegiatan! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
      }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $data = LessonPlanActivity::findOrFail($id);
    $data->update([
          'is_deleted'   => TRUE
      ]);
    Alert::success('Berhasil', 'Kegiatan Pembelajaran Berhasil Dihapus');
    return redirect()->back();
  }
}
