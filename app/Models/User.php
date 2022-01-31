<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
      'email',
      'password',
      'student_personal_data_id',
      'teacher_personal_data_id',
      'executive_personal_data_id',
      'parent_personal_data_id',
      'school_id',
      'role_id',
      'is_verified',
      'is_deleted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

     public function teachingHour()
     {
       return $this->hasMany('App\Models\TeachingHour', 'id');
     }

     public function classTaskCollection()
     {
       return $this->hasMany('App\Models\ClassTaskCollection', 'id');
     }

     public function role()
     {
       return $this->belongsTo('App\Models\Roles', 'role_id');
     }

     public function schooll()
     {
       return $this->belongsTo('App\Models\School', 'school_id');
     }

     public function teacherPersonalData()
     {
       return $this->belongsTo('App\Models\TeacherPersonalData', 'teacher_personal_data_id');
     }

     public function studentPersonalData()
     {
       return $this->belongsTo('App\Models\StudentPersonalData', 'student_personal_data_id');
     }

     public function parentPersonalData()
     {
       return $this->belongsTo('App\Models\ParentPersonalData', 'parent_personal_data_id');
     }

     public function executivePersonalData()
     {
       return $this->belongsTo('App\Models\ExecutivePersonalData', 'executive_personal_data_id');
     }

     public function studentEnrolled()
     {
       return $this->hasMany('App\Models\StudentEnrolled', 'id');
     }

     public function classQuizCollection()
     {
       return $this->hasMany('App\Models\ClassQuizCollection', 'id');
     }

     public function classExamCollection()
     {
       return $this->hasMany('App\Models\ClassExamCollection', 'id');
     }

     public function meetingRoomAttendanceDetail()
     {
       return $this->hasMany('App\Models\MeetingRoomAttendanceDetail', 'id');
     }

     public function lessonPlan()
     {
       return $this->hasMany('App\Models\LessonPlan', 'id');
     }

     public function LessonResultDetail()
     {
       return $this->hasMany('App\Models\LessonResultDetail', 'id');
     }

     public function VerifiedUser()
     {
       return $this->hasMany('App\Models\VerifiedUser', 'id');
     }
}
