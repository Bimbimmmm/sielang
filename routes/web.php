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

//PRINCIPAL ROUTES
Route::get('/principal', [PrincipalController::class, 'index'])->middleware('can:isPrincipal')->name('principal');
//Principal Teaaching Routes
Route::get('/principal/teaching', [PrincipalTeachingController::class, 'index'])->middleware('can:isPrincipal')->name('principalteachingindex');
Route::get('/principal/teaching/create', [PrincipalTeachingController::class, 'create'])->middleware('can:isPrincipal')->name('principalteachingcreate');
Route::post('/principal/teaching/store', [PrincipalTeachingController::class, 'store'])->middleware('can:isPrincipal')->name('principalteachingstore');


//STUDENT ROUTES

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
