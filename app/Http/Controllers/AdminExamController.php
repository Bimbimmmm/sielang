<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassExam;
use App\Models\ClassExamCollection;

class AdminExamController extends Controller
{
  public function index()
  {
      $datas=ClassExam::where('is_deleted', FALSE)->get();
      return view('administrator/exam/index', compact('datas'));
  }

  public function show($id)
  {
      $detail=ClassExam::where('id', $id)->first();
      $datas=ClassExamCollection::where('meeting_exam_id', $id)->get();
      return view('administrator/exam/show', compact('detail', 'datas'));
  }

  public function destroy($id)
  {
    $data = ClassExam::findOrFail($id);
    $data->update([
          'is_deleted'   => TRUE
      ]);

    $check=ClassExam::where(['id' => $id, 'is_deleted' => TRUE])->count();

    if($count > 0){
      Alert::success('Berhasil', 'Ujian Berhasil Dihapus');
      return redirect()->back();
    }else{
      Alert::error('Gagal', 'Ujian Gagal Dihapus');
      return redirect()->back();
    }
  }
}
