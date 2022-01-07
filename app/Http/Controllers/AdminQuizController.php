<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassQuiz;
use App\Models\ClassQuizCollection;

class AdminQuizController extends Controller
{
  public function index()
  {
      $datas=ClassQuiz::where('is_deleted', FALSE)->get();
      return view('administrator/quiz/index', compact('datas'));
  }

  public function show($id)
  {
      $detail=ClassQuiz::where('id', $id)->first();
      $datas=ClassQuizCollection::where('meeting_quiz_id', $id)->get();
      return view('administrator/quiz/show', compact('detail', 'datas'));
  }

  public function destroy($id)
  {
    $data = ClassQuiz::findOrFail($id);
    $data->update([
          'is_deleted'   => TRUE
      ]);

    $check=ClassQuiz::where(['id' => $id, 'is_deleted' => TRUE])->count();

    if($count > 0){
      Alert::success('Berhasil', 'Kuis Berhasil Dihapus');
      return redirect()->back();
    }else{
      Alert::error('Gagal', 'Kuis Gagal Dihapus');
      return redirect()->back();
    }
  }
}
