<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassQuiz extends Model
{
    use HasFactory;
    protected $table = 'meeting_quiz';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'teaching_hour_id',
        'file',
        'is_locked',
        'is_active',
        'is_deleted'
    ];

    protected $dates = [
      'start_date',
      'expired_date',
    ];

    public function teachingHour()
    {
      return $this->belongsTo('App\Models\TeachingHour', 'teaching_hour_id');
    }

    public function classQuizQuestion()
    {
      return $this->hasMany('App\Models\ClassQuizQuestion', 'id');
    }
}
