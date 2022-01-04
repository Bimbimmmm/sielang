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

class TeacherLessonPlanObjectiveController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('teacher/plan/objective/create', compact('id'));
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
            'objective' => 'required'
        ];

        $messages = [
            'objective.required'  => 'Tujuan Pembelajaran Wajib Dipilih'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = new LessonPlanObjective;
        $data->lesson_plan_id = $id;
        $data->objective = $request->objective;
        $data->is_deleted = FALSE;
        $save = $data->save();

        if($save){
            Alert::success('Berhasil', 'Tujuan Berhasil Ditambahkan');
            return redirect()->route('teacherlessonplanshow', $id);
        } else {
            Alert::error('Gagal', 'Gagal Menambahkan Tujuan! Silahkan ulangi beberapa saat lagi');
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
      $data = LessonPlanObjective::findOrFail($id);
      $data->update([
            'is_deleted'   => TRUE
        ]);
      Alert::success('Berhasil', 'Tujuan Pembelajaran Berhasil Dihapus');
      return redirect()->back();
    }
}
