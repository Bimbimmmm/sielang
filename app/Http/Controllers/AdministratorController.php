<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeachingHour;
use App\Models\LessonResult;
use App\Models\MeetingRoomAttendance;
use App\Models\ClassTask;
use App\Models\ClassQuiz;
use App\Models\ClassExam;
use App\Models\LessonPlan;
use App\Models\ReferenceSchools;
use App\Models\Subject;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_count=User::where('is_deleted', FALSE)->count();
        $teaching_hour_count=TeachingHour::where('is_deleted', FALSE)->count();
        $lesson_result_count=LessonResult::where('is_deleted', FALSE)->count();
        $attendance_count=MeetingRoomAttendance::where('is_deleted', FALSE)->count();
        $task_count=ClassTask::where('is_deleted', FALSE)->count();
        $quiz_count=ClassQuiz::where('is_deleted', FALSE)->count();
        $exam_count=ClassExam::where('is_deleted', FALSE)->count();
        $lesson_plan_count=LessonPlan::where('is_deleted', FALSE)->count();
        $rs_count=ReferenceSchools::where('is_deleted', FALSE)->count();
        $subject_count=Subject::where('is_deleted', FALSE)->count();
        return view('administrator/index', compact(
          'user_count', 'teaching_hour_count', 'lesson_result_count', 'attendance_count',
          'task_count', 'quiz_count', 'exam_count', 'lesson_plan_count', 'rs_count', 'subject_count'
        ));
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
