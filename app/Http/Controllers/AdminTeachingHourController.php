<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeachingHour;

class AdminTeachingHourController extends Controller
{
  public function index()
  {
      $datas=TeachingHour::where('is_deleted', FALSE)->get();
      return view('administrator/teaching/index', compact('datas'));
  }

  public function destroy($id)
  {
    $data = TeachingHour::findOrFail($id);
    $data->update([
          'is_deleted'   => TRUE
      ]);
      
    $check=TeachingHour::where(['id' => $id, 'is_deleted' => TRUE])->count();

    if($count > 0){
      Alert::success('Berhasil', 'Jam Mengajar Berhasil Dihapus');
      return redirect()->back();
    }else{
      Alert::error('Gagal', 'Jam Mengajar Gagal Dihapus');
      return redirect()->back();
    }
  }

}
