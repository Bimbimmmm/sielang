<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\PrincipalTeachingController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\OperatorUserController;
use App\Http\Controllers\OperatorClassController;
use App\Http\Controllers\OperatorSubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherTeachingController;
use App\Http\Controllers\TeacherMeetingRoomController;
use App\Http\Controllers\TeacherMeetingClassTaskController;
use App\Http\Controllers\TeacherMeetingClassQuizController;
use App\Http\Controllers\TeacherMeetingClassExamController;
use App\Http\Controllers\TeacherLessonPlanController;
use App\Http\Controllers\TeacherLessonPlanObjectiveController;
use App\Http\Controllers\TeacherLessonPlanMediaController;
use App\Http\Controllers\TeacherLessonPlanActivityController;
use App\Http\Controllers\TeacherLessonPlanAssesmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentClassListController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentClassTaskController;
use App\Http\Controllers\StudentClassQuizController;
use App\Http\Controllers\StudentClassExamController;
use App\Http\Controllers\StudentClassMeetingRoomController;
use App\Http\Controllers\StudentScoreController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::get('getCity/{id}', function ($id) {
    $cities = App\Models\Cities::where('province_code',$id)->get();
    return response()->json($cities);
});

Route::get('getDistrict/{id}', function ($id) {
    $districts = App\Models\Districts::where('city_code',$id)->get();
    return response()->json($districts);
});

Route::get('getVillage/{id}', function ($id) {
    $villages = App\Models\Villages::where('district_code',$id)->get();
    return response()->json($villages);
});

//ADMINISTRATOR ROUTES
Route::get('/administrator', [AdministratorController::class, 'index'])->middleware('can:isAdmin')->name('administrator');
//Admin User Routes
Route::get('/administrator/users', [AdminUserController::class, 'index'])->middleware('can:isAdmin')->name('adminuserindex');
Route::get('/administrator/users/create', [AdminUserController::class, 'create'])->middleware('can:isAdmin')->name('adminusercreate');
Route::post('/administrator/users/store', [AdminUserController::class, 'store'])->middleware('can:isAdmin')->name('adminuserstore');

//TEACHER ROUTES
Route::get('/teacher', [TeacherController::class, 'index'])->middleware('can:isTeacher')->name('teacher');
//Teacher Class Room
Route::get('/teacher/teaching', [TeacherTeachingController::class, 'index'])->middleware('can:isTeacher')->name('teacherteachingindex');
Route::post('/teacher/teaching/store', [TeacherTeachingController::class, 'store'])->middleware('can:isTeacher')->name('teacherteachingstore');
Route::get('/teacher/teaching/show/{id}', [TeacherTeachingController::class, 'show'])->middleware('can:isTeacher')->name('teacherteachingshow');
Route::get('/teacher/teaching/inactive/{id}', [TeacherTeachingController::class, 'inactive'])->middleware('can:isTeacher')->name('teacherteachinginactive');
//Teacher Meeting Room Routes
Route::get('/teacher/class/meetingroom/create/{id}', [TeacherMeetingRoomController::class, 'create'])->middleware('can:isTeacher')->name('teachermrcreate');
Route::post('/teacher/class/meetingroom/store/{id}', [TeacherMeetingRoomController::class, 'store'])->middleware('can:isTeacher')->name('teachermrstore');
Route::get('/teacher/class/meetingroom/show/{id}/{idc}', [TeacherMeetingRoomController::class, 'show'])->middleware('can:isTeacher')->name('teachermrshow');
Route::post('/teacher/class/meetingroom/lock/{id}/{idc}', [TeacherMeetingRoomController::class, 'inactive'])->middleware('can:isTeacher')->name('teachermrinactive');
Route::get('/teacher/class/meetingroom/attendance/{id}/{idc}/{ida}', [TeacherMeetingRoomController::class, 'attendance'])->middleware('can:isTeacher')->name('teachermrattshow');
Route::post('/teacher/class/meetingroom/attendance/attend/{id}', [TeacherMeetingRoomController::class, 'attend'])->middleware('can:isTeacher')->name('teachermrattendstore');
Route::post('/teacher/class/meetingroom/attendance/absent/{id}', [TeacherMeetingRoomController::class, 'absent'])->middleware('can:isTeacher')->name('teachermrabsentstore');
Route::post('/teacher/class/meetingroom/attendance/lock/{id}/{idm}/{idc}', [TeacherMeetingRoomController::class, 'lock'])->middleware('can:isTeacher')->name('teachermrattlockstore');

//Teacher Class Task Routes
Route::get('/teacher/class/task/create/{id}', [TeacherMeetingClassTaskController::class, 'create'])->middleware('can:isTeacher')->name('teachertaskcreate');
Route::post('/teacher/class/task/store/{id}', [TeacherMeetingClassTaskController::class, 'store'])->middleware('can:isTeacher')->name('teachertaskstore');
Route::get('/teacher/class/task/show/{id}/{idt}', [TeacherMeetingClassTaskController::class, 'show'])->middleware('can:isTeacher')->name('teachertaskshow');
Route::get('/teacher/class/task/collection/show/{id}/{idts}/{idt}', [TeacherMeetingClassTaskController::class, 'showcol'])->middleware('can:isTeacher')->name('teachertaskcolshow');
Route::post('/teacher/class/task/collection/score/{id}/{idts}/{idt}', [TeacherMeetingClassTaskController::class, 'score'])->middleware('can:isTeacher')->name('teachertaskcolscore');
Route::get('/teacher/class/task/collection/destroy/{id}', [TeacherMeetingClassTaskController::class, 'destroy'])->middleware('can:isTeacher')->name('teachertaskcoldestroy');
Route::post('/teacher/class/task/inactive/{id}/{idc}', [TeacherMeetingClassTaskController::class, 'inactive'])->middleware('can:isTeacher')->name('teachertaskinactive');
//Teacher Class Quiz Routes
Route::get('/teacher/class/quiz/create/{id}', [TeacherMeetingClassQuizController::class, 'create'])->middleware('can:isTeacher')->name('teacherquizcreate');
Route::post('/teacher/class/quiz/store/{id}', [TeacherMeetingClassQuizController::class, 'store'])->middleware('can:isTeacher')->name('teacherquizstore');
Route::get('/teacher/class/quiz/show/{id}/{idt}', [TeacherMeetingClassQuizController::class, 'show'])->middleware('can:isTeacher')->name('teacherquizshow');
Route::post('/teacher/class/quiz/lock/{id}', [TeacherMeetingClassQuizController::class, 'lock'])->middleware('can:isTeacher')->name('teacherquizlock');
Route::post('/teacher/class/quiz/inactive/{id}/{idt}', [TeacherMeetingClassQuizController::class, 'inactive'])->middleware('can:isTeacher')->name('teacherquizinactive');
Route::get('/teacher/class/quiz/create/question/{id}/{idt}', [TeacherMeetingClassQuizController::class, 'createquestion'])->middleware('can:isTeacher')->name('teacherquizcrquestion');
Route::post('/teacher/class/quiz/question/store/{id}/{idt}', [TeacherMeetingClassQuizController::class, 'storequestion'])->middleware('can:isTeacher')->name('teacherquizstorequestion');
Route::get('/teacher/class/quiz/question/show/{id}/{idq}/{idt}', [TeacherMeetingClassQuizController::class, 'showquestion'])->middleware('can:isTeacher')->name('teacherquizshowquestion');
Route::get('/teacher/class/quiz/question/delete/{id}', [TeacherMeetingClassQuizController::class, 'delete'])->middleware('can:isTeacher')->name('teacherquizdeletequestion');
Route::get('/teacher/class/quiz/collection/show/{id}/{idq}/{idt}', [TeacherMeetingClassQuizController::class, 'showcol'])->middleware('can:isTeacher')->name('teacherquizshowcol');
Route::post('/teacher/class/quiz/collection/score/{id}/{idq}/{idt}', [TeacherMeetingClassQuizController::class, 'score'])->middleware('can:isTeacher')->name('teacherquizcolscore');

//Teacher Class Exam Routes
Route::get('/teacher/class/exam/create/{id}', [TeacherMeetingClassExamController::class, 'create'])->middleware('can:isTeacher')->name('teacherexamcreate');
Route::post('/teacher/class/exam/store/{id}', [TeacherMeetingClassExamController::class, 'store'])->middleware('can:isTeacher')->name('teacherexamstore');
Route::get('/teacher/class/exam/show/{id}/{idt}', [TeacherMeetingClassExamController::class, 'show'])->middleware('can:isTeacher')->name('teacherexamshow');
Route::post('/teacher/class/exam/lock/{id}', [TeacherMeetingClassExamController::class, 'lock'])->middleware('can:isTeacher')->name('teacherexamlock');
Route::get('/teacher/class/exam/create/question/{id}/{idt}', [TeacherMeetingClassExamController::class, 'createquestion'])->middleware('can:isTeacher')->name('teacherexamcrquestion');
Route::post('/teacher/class/exam/question/store/{id}/{idt}', [TeacherMeetingClassExamController::class, 'storequestion'])->middleware('can:isTeacher')->name('teacherexamstorequestion');
Route::get('/teacher/class/exam/question/show/{id}/{idq}/{idt}', [TeacherMeetingClassExamController::class, 'showquestion'])->middleware('can:isTeacher')->name('teacherexamshowquestion');
Route::get('/teacher/class/exam/question/delete/{id}', [TeacherMeetingClassExamController::class, 'delete'])->middleware('can:isTeacher')->name('teacherexamdeletequestion');
Route::post('/teacher/class/exam/inactive/{id}/{idt}', [TeacherMeetingClassExamController::class, 'inactive'])->middleware('can:isTeacher')->name('teacherexaminactive');
Route::get('/teacher/class/exam/collection/show/{id}/{idq}/{idt}', [TeacherMeetingClassExamController::class, 'showcol'])->middleware('can:isTeacher')->name('teacherexamshowcol');
Route::post('/teacher/class/exam/collection/score/{id}/{idq}/{idt}', [TeacherMeetingClassExamController::class, 'score'])->middleware('can:isTeacher')->name('teacherexamcolscore');

//Teacher Lesson Plan Routes
Route::get('/teacher/lessonplan', [TeacherLessonPlanController::class, 'index'])->middleware('can:isTeacher')->name('teacherlessonplanindex');
Route::get('/teacher/lessonplan/create', [TeacherLessonPlanController::class, 'create'])->middleware('can:isTeacher')->name('teacherlessonplancreate');
Route::post('/teacher/lessonplan/store', [TeacherLessonPlanController::class, 'store'])->middleware('can:isTeacher')->name('teacherlessonplanstore');
Route::get('/teacher/lessonplan/show/{id}', [TeacherLessonPlanController::class, 'show'])->middleware('can:isTeacher')->name('teacherlessonplanshow');
//Teacher Lesson Plan Objective Routes
Route::get('/teacher/lessonplan/objective/create/{id}', [TeacherLessonPlanObjectiveController::class, 'create'])->middleware('can:isTeacher')->name('teacherlessonplanobjcreate');
Route::post('/teacher/lessonplan/objective/store/{id}', [TeacherLessonPlanObjectiveController::class, 'store'])->middleware('can:isTeacher')->name('teacherlessonplanobjstore');
Route::get('/teacher/lessonplan/objective/destroy/{id}', [TeacherLessonPlanObjectiveController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherlessonplanobjdestroy');
//Teacher Lesson Plan Media Routes
Route::get('/teacher/lessonplan/media/create/{id}', [TeacherLessonPlanMediaController::class, 'create'])->middleware('can:isTeacher')->name('teacherlessonplanmdcreate');
Route::post('/teacher/lessonplan/media/store/{id}', [TeacherLessonPlanMediaController::class, 'store'])->middleware('can:isTeacher')->name('teacherlessonplanmdstore');
Route::get('/teacher/lessonplan/media/destroy/{id}', [TeacherLessonPlanMediaController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherlessonplanmddestroy');
//Teacher Lesson Plan Activity Routes
Route::get('/teacher/lessonplan/activity/create/{id}', [TeacherLessonPlanActivityController::class, 'create'])->middleware('can:isTeacher')->name('teacherlessonplanactcreate');
Route::post('/teacher/lessonplan/activity/store/{id}', [TeacherLessonPlanActivityController::class, 'store'])->middleware('can:isTeacher')->name('teacherlessonplanactstore');
Route::get('/teacher/lessonplan/activity/destroy/{id}', [TeacherLessonPlanActivityController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherlessonplanactdestroy');
//Teacher Lesson Plan Assesment Routes
Route::get('/teacher/lessonplan/assesment/create/{id}', [TeacherLessonPlanAssesmentController::class, 'create'])->middleware('can:isTeacher')->name('teacherlessonplanasscreate');
Route::post('/teacher/lessonplan/assesment/store/{id}', [TeacherLessonPlanAssesmentController::class, 'store'])->middleware('can:isTeacher')->name('teacherlessonplanassstore');
Route::get('/teacher/lessonplan/assesment/destroy/{id}', [TeacherLessonPlanAssesmentController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherlessonplanassdestroy');

//PRINCIPAL ROUTES
Route::get('/principal', [PrincipalController::class, 'index'])->middleware('can:isPrincipal')->name('principal');
//Principal Teaaching Routes
Route::get('/principal/teaching', [PrincipalTeachingController::class, 'index'])->middleware('can:isPrincipal')->name('principalteachingindex');
Route::get('/principal/teaching/create', [PrincipalTeachingController::class, 'create'])->middleware('can:isPrincipal')->name('principalteachingcreate');
Route::post('/principal/teaching/store', [PrincipalTeachingController::class, 'store'])->middleware('can:isPrincipal')->name('principalteachingstore');


//STUDENT ROUTES
Route::get('/student', [StudentController::class, 'index'])->middleware('can:isStudent')->name('student');
//Student Studying Routes
Route::get('/student/classlist', [StudentClassListController::class, 'index'])->middleware('can:isStudent')->name('studentcl');
Route::get('/student/classlist/enrolled/{id}', [StudentClassListController::class, 'enrolled'])->middleware('can:isStudent')->name('studentclenrolled');
//Student Class Routes
Route::get('/student/class', [StudentClassController::class, 'index'])->middleware('can:isStudent')->name('studentclass');
Route::get('/student/class/show/{id}', [StudentClassController::class, 'show'])->middleware('can:isStudent')->name('studentclasshow');
//Student Class Meeting Room Routes
Route::get('/student/class/meetingroom/show/{id}/{idc}', [StudentClassMeetingRoomController::class, 'show'])->middleware('can:isStudent')->name('studentclassmrshow');
//Student Class Task Routes
Route::get('/student/class/task/show/{id}/{idc}', [StudentClassTaskController::class, 'show'])->middleware('can:isStudent')->name('studentclasstaskshow');
Route::post('/student/class/task/store/{id}', [StudentClassTaskController::class, 'store'])->middleware('can:isStudent')->name('studentclasstaskstore');
//Student Class Quiz Routes
Route::get('/student/class/quiz/show/{id}/{idc}', [StudentClassQuizController::class, 'show'])->middleware('can:isStudent')->name('studentclassquizshow');
Route::post('/student/class/quiz/startwork/{id}/{idc}', [StudentClassQuizController::class, 'startwork'])->middleware('can:isStudent')->name('studentclassquizstartwork');
Route::get('/student/class/quiz/work/{id}/{idc}/{idcol}/{idqs}', [StudentClassQuizController::class, 'work'])->middleware('can:isStudent')->name('studentclassquizwork');
Route::post('/student/class/quiz/answer/{id}/{idc}/{idcol}/{idqs}', [StudentClassQuizController::class, 'answer'])->middleware('can:isStudent')->name('studentclassquizanswer');
Route::post('/student/class/quiz/finish/{id}/{idc}/{idcol}', [StudentClassQuizController::class, 'finish'])->middleware('can:isStudent')->name('studentclassquizfinish');
//Student Class Exam Routes
Route::get('/student/class/exam/show/{id}/{idc}', [StudentClassExamController::class, 'show'])->middleware('can:isStudent')->name('studentclassexamshow');
Route::post('/student/class/exam/startwork/{id}/{idc}', [StudentClassExamController::class, 'startwork'])->middleware('can:isStudent')->name('studentclassexamstartwork');
Route::get('/student/class/exam/work/{id}/{idc}/{idcol}/{idqs}', [StudentClassExamController::class, 'work'])->middleware('can:isStudent')->name('studentclassexamwork');
Route::post('/student/class/exam/answer/{id}/{idc}/{idcol}/{idqs}', [StudentClassExamController::class, 'answer'])->middleware('can:isStudent')->name('studentclassexamanswer');
Route::post('/student/class/exam/finish/{id}/{idc}/{idcol}', [StudentClassExamController::class, 'finish'])->middleware('can:isStudent')->name('studentclassexamfinish');
//Student Scores Routes
Route::get('/student/scores', [StudentScoreController::class, 'index'])->middleware('can:isStudent')->name('studentscoreindex');
//OPERATOR ROUTES
Route::get('/operator', [OperatorController::class, 'index'])->middleware('can:isOperator')->name('operator');
//Operator User Routes
Route::get('/operator/users', [OperatorUserController::class, 'index'])->middleware('can:isOperator')->name('operatoruserindex');
Route::get('/operator/users/create', [OperatorUserController::class, 'create'])->middleware('can:isOperator')->name('operatorusercreate');
Route::post('/operator/users/store', [OperatorUserController::class, 'store'])->middleware('can:isOperator')->name('operatoruserstore');

//Operator Class Routes
Route::get('/operator/class', [OperatorClassController::class, 'index'])->middleware('can:isOperator')->name('operatorclassindex');
Route::get('/operator/class/create', [OperatorClassController::class, 'create'])->middleware('can:isOperator')->name('operatorclasscreate');
Route::post('/operator/class/store', [OperatorClassController::class, 'store'])->middleware('can:isOperator')->name('operatorclasstore');

//Operator Subject Routes
Route::get('/operator/subject', [OperatorSubjectController::class, 'index'])->middleware('can:isOperator')->name('operatorsubjectindex');
Route::get('/operator/subject/create', [OperatorSubjectController::class, 'create'])->middleware('can:isOperator')->name('operatorsubjectcreate');
Route::post('/operator/subject/store', [OperatorSubjectController::class, 'store'])->middleware('can:isOperator')->name('operatorsubjecttore');

//EXECUTIVE ROUTES
