<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonPlan;
use App\Models\LessonPlanActivity;
use App\Models\LessonPlanAssesment;
use App\Models\LessonPlanObjective;
use App\Models\LessonPlanMedia;

class AdminLessonPlanController extends Controller
{
  public function index()
  {
      $datas=LessonPlan::where('is_deleted', FALSE)->get();
      return view('administrator/lessonplan/index', compact('datas'));
  }

  public function show($id)
  {
      $data=LessonPlan::where('id', $id)->first();
      $objectives=LessonPlanObjective::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      $medias=LessonPlanMedia::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      $activities=LessonPlanActivity::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      $assesments=LessonPlanAssesment::where(['lesson_plan_id' => $data->id, 'is_deleted' => FALSE])->get();
      return view('administrator/lessonplan/show', compact('data', 'objectives', 'medias', 'activities', 'assesments'));
  }

  public function destroy($id)
  {
    $data = LessonPlan::findOrFail($id);
    $data->update([
          'is_deleted'   => TRUE
      ]);

    $check=LessonPlan::where(['id' => $id, 'is_deleted' => TRUE])->count();

    if($count > 0){
      Alert::success('Berhasil', 'RPP Berhasil Dihapus');
      return redirect()->back();
    }else{
      Alert::error('Gagal', 'RPP Gagal Dihapus');
      return redirect()->back();
    }
  }
}
