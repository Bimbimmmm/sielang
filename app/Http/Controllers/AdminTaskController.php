<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassTask;
use App\Models\ClassTaskCollection;

class AdminTaskController extends Controller
{
  public function index()
  {
      $datas=ClassTask::where('is_deleted', FALSE)->get();
      return view('administrator/task/index', compact('datas'));
  }

  public function show($id)
  {
      $detail=ClassTask::where('id', $id)->first();
      $datas=ClassTaskCollection::where('meeting_task_id', $id)->get();
      return view('administrator/task/show', compact('detail', 'datas'));
  }

  public function destroy($id)
  {
    $data = ClassTask::findOrFail($id);
    $data->update([
          'is_deleted'   => TRUE
      ]);

    $check=ClassTask::where(['id' => $id, 'is_deleted' => TRUE])->count();

    if($count > 0){
      Alert::success('Berhasil', 'Tugas Berhasil Dihapus');
      return redirect()->back();
    }else{
      Alert::error('Gagal', 'Tugas Gagal Dihapus');
      return redirect()->back();
    }
  }
}
