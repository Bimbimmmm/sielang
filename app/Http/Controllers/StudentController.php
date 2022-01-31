<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeachingHour;
use App\Models\StudentEnrolled;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $school_id = auth()->user()->school_id;
        $teach=TeachingHour::where(['school_id' => $school_id, 'is_active' => TRUE, 'is_deleted' => FALSE])->count();
        $teach_all=TeachingHour::count();
        $enrolled=StudentEnrolled::where(['user_id' => $user_id, 'is_active' => TRUE, 'is_deleted' => FALSE])->count();
        $enrolled_all=StudentEnrolled::where('user_id', $user_id)->count();
        return view('student/index', compact('teach', 'enrolled', 'teach_all', 'enrolled_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
