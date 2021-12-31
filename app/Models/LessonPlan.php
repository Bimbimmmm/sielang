<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPlan extends Model
{
    use HasFactory;
    protected $table = 'lesson_plan';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'user_id',
        'teaching_hour_id',
        'type',
        'is_active',
        'is_deleted'
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function teachingHour()
    {
      return $this->belongsTo('App\Models\TeachingHour', 'teaching_hour_id');
    }

    public function lessonPlanActivity()
    {
      return $this->hasMany('App\Models\LessonPlanActivity', 'id');
    }

    public function lessonPlanAssesment()
    {
      return $this->hasMany('App\Models\LessonPlanAssesment', 'id');
    }

    public function lessonPlanObjective()
    {
      return $this->hasMany('App\Models\LessonPlanObjective', 'id');
    }
}
