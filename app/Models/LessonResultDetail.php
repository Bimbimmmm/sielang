<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonResultDetail extends Model
{
    use HasFactory;
    protected $table = 'lesson_result_detail';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'lesson_result_id',
        'user_id',
        'attendance',
        'task',
        'quiz',
        'exam'
    ];

    public function lessonResult()
    {
      return $this->belongsTo('App\Models\LessonResult', 'lesson_result_id');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
    
}
