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

class TeacherLessonPlanAssesmentController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
      return view('teacher/plan/assesment/create', compact('id'));
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
          'assesment' => 'required'
      ];

      $messages = [
          'assesment.required'  => 'Penilaian Pembelajaran Wajib Dipilih'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $data = new LessonPlanAssesment;
      $data->lesson_plan_id = $id;
      $data->assesment = $request->assesment;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
          Alert::success('Berhasil', 'Penilaian Berhasil Ditambahkan');
          return redirect()->route('teacherlessonplanshow', $id);
      } else {
          Alert::error('Gagal', 'Gagal Menambahkan Penilaian! Silahkan ulangi beberapa saat lagi');
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
    $data = LessonPlanAssesment::findOrFail($id);
    $data->update([
          'is_deleted'   => TRUE
      ]);
    Alert::success('Berhasil', 'Penilaian Berhasil Dihapus');
    return redirect()->back();
  }
}
