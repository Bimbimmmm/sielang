<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonResult;
use App\Models\LessonResultDetail;

class AdminLessonResultController extends Controller
{
  public function index()
  {
      $datas=LessonResult::where('is_deleted', FALSE)->get();
      return view('administrator/lessonresult/index', compact('datas'));
  }

  public function show($id)
  {
      $detail=LessonResult::where('id', $id)->first();
      $datas=LessonResultDetail::where('lesson_result_id', $id)->get();
      return view('administrator/lessonresult/show', compact('detail', 'datas'));
  }

  public function destroy($id)
  {
    $data = LessonResult::findOrFail($id);
    $data->update([
          'is_deleted'   => TRUE
      ]);

    $check=LessonResult::where(['id' => $id, 'is_deleted' => TRUE])->count();

    if($count > 0){
      Alert::success('Berhasil', 'Hasil Pembelajaran Berhasil Dihapus');
      return redirect()->back();
    }else{
      Alert::error('Gagal', 'Hasil Pembelajaran Gagal Dihapus');
      return redirect()->back();
    }
  }
}
