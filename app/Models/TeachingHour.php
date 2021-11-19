<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingHour extends Model
{
    use HasFactory;
    protected $table = 'teaching_hour';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'user_id',
        'subject_id',
        'class_id',
        'hour',
        'semester_period',
        'year',
        'is_active',
        'is_deleted'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }


    public function subject()
    {
      return $this->belongsTo('App\Models\Subject', 'subject_id');
    }


    public function classmodel()
    {
      return $this->belongsTo('App\Models\ClassModel', 'class_id');
    }

    public function meetingRoom()
    {
      return $this->hasMany('App\Models\MeetingRoom', 'id');
    }

    public function classExam()
    {
      return $this->hasMany('App\Models\ClassExam', 'id');
    }

    public function classQuiz()
    {
      return $this->hasMany('App\Models\ClassQuiz', 'id');
    }

    public function classTask()
    {
      return $this->hasMany('App\Models\ClassTask', 'id');
    }


}
