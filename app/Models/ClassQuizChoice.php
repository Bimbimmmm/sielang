<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassQuizChoice extends Model
{
    use HasFactory;
    protected $table = 'meeting_quiz_choice';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'meeting_quiz_question_id',
        'choice',
        'is_answer'
    ];

    public function meetingQuizQuestion()
    {
      return $this->belongsTo('App\Models\MeetingQuizQuestion', 'meeting_quiz_question_id');
    }
}
