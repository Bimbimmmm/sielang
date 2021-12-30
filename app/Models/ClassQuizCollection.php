<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassQuizCollection extends Model
{
    use HasFactory;
    protected $table = 'meeting_quiz_collection';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'meeting_quiz_id',
        'user_id',
        'multiple_choice_score',
        'essay_score',
        'total_score',
        'is_finished',
        'is_scored',
        'is_deleted'
    ];

    public function meetingQuiz()
    {
      return $this->belongsTo('App\Models\ClassQuiz', 'meeting_quiz_id');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function classQuizCollectionAnswer()
    {
      return $this->hasMany('App\Models\ClassQuizCollectionAnswer', 'id');
    }
}
