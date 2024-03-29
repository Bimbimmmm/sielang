<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassQuizQuestion extends Model
{
    use HasFactory;
    protected $table = 'meeting_quiz_question';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'meeting_quiz_id',
        'question',
        'question_file',
        'is_multiple_choice',
        'is_deleted'
    ];

    public function meetingQuiz()
    {
      return $this->belongsTo('App\Models\ClassQuiz', 'meeting_quiz_id');
    }

    public function ClassQuizChoice()
    {
      return $this->hasMany('App\Models\ClassQuizChoice', 'id');
    }

    public function classQuizCollectionAnswer()
    {
      return $this->hasMany('App\Models\ClassQuizCollectionAnswer', 'id');
    }
}
