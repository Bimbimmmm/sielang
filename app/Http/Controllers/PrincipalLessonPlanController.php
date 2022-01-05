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

class PrincipalLessonPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $school_id = auth()->user()->school_id;
      $datas=LessonPlan::where(['school_id' => $school_id, 'is_locked' => TRUE, 'is_accepted' => FALSE, 'is_deleted' => FALSE])->get();
      return view('principal/plan/index', compact('datas'));
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
      return view('principal/plan/show', compact('data', 'objectives', 'medias', 'activities', 'assesments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
      $data = LessonPlan::findOrFail($id);
      $data->update([
            'is_accepted'   => TRUE
        ]);

      $check=LessonPlan::where(['id' => $id, 'is_accepted' => TRUE])->count();
      if($check > 0){
        Alert::success('Berhasil', 'RPP Berhasil Disetujui');
        return redirect()->route('principallpindex');
      }else{
        Alert::error('Gagal', 'RPP Tidak Dapat Disetujui, Mohon Ulangi Beberapa Saat Lagi');
        return redirect()->back();
      }
    }
}
