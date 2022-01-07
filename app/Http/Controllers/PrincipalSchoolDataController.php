<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceSchools;

class PrincipalSchoolDataController extends Controller
{
    public function index(){
      $school_id = auth()->user()->school_id;
      $data=ReferenceSchools::where('id', $school_id)->first();

      return view('principal/schooldata/index', compact('data'));
    }
}
