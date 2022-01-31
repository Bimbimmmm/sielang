<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceSchools;

class ExecutiveSchoolDataController extends Controller
{
    public function index(){
      $schools=ReferenceSchools::where('is_deleted', FALSE)->get();
      return view('executive/schooldata/index', compact('schools'));
    }

    public function show($id){
      $data=ReferenceSchools::where('id', $id)->first();
      return view('executive/schooldata/show', compact('data'));
    }
}
