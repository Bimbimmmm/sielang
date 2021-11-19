<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassExamChoice extends Model
{
    use HasFactory;
    protected $table = 'meeting_exam_choice';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'meeting_exam_question_id',
        'choice',
        'is_answer'
    ];

    public function meetingExamQuestion()
    {
      return $this->belongsTo('App\Models\MeetingExamQuestion', 'meeting_exam_question_id');
    }
}
