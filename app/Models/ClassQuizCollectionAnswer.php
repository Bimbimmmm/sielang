<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassQuizCollectionAnswer extends Model
{
    use HasFactory;
    protected $table = 'meeting_quiz_answer';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'meeting_quiz_collection_id',
        'meeting_quiz_question_id',
        'answer',
        'is_multiple_choice',
        'is_true'
    ];

    public function meetingQuizCollection()
    {
      return $this->belongsTo('App\Models\ClassQuizCollection', 'meeting_quiz_collection_id');
    }

    public function meetingQuizQuestion()
    {
      return $this->belongsTo('App\Models\ClassQuizQuestion', 'meeting_quiz_question_id');
    }

}
