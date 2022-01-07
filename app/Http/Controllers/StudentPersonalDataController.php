<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPersonalData;

class StudentPersonalDataController extends Controller
{
  public function index()
  {
    $user_id = auth()->user()->student_personal_data_id;
    $data=StudentPersonalData::where('id', $user_id)->first();
    return view('student/personaldata/index', compact('data'));
  }
}
