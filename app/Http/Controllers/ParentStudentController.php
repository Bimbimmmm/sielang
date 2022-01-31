<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPersonalData;
use App\Models\ParentPersonalData;
use Alert;

class ParentStudentController extends Controller
{
    public function index(){
      $ppd_id = auth()->user()->parent_personal_data_id;
      $ppd=ParentPersonalData::where('id', $ppd_id)->first();
      $data=StudentPersonalData::where('id', $ppd->student_personal_data_id)->first();
      return view('parents/studentdata/index', compact('data'));
    }
}
