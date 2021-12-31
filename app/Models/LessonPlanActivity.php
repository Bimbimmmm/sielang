<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPlanActivity extends Model
{
    use HasFactory;
    protected $table = 'lesson_plan_activity';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'lesson_plan_id',
        'type',
        'activity',
        'is_deleted'
    ];

    public function lessonPlan()
    {
      return $this->belongsTo('App\Models\LessonPlan', 'lesson_plan_id');
    }
}
