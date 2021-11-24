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
      'school_id',
      'role_id',
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
}
