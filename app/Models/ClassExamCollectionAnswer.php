<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassExamCollectionAnswer extends Model
{
    use HasFactory;
    protected $table = 'meeting_exam_answer';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'meeting_exam_collection_id',
        'meeting_exam_question_id',
        'answer',
        'is_multiple_choice',
        'is_true'
    ];

    public function meetingExamCollection()
    {
      return $this->belongsTo('App\Models\ClassExamCollection', 'meeting_exam_collection_id');
    }

    public function meetingExamQuestion()
    {
      return $this->belongsTo('App\Models\ClassExamQuestion', 'meeting_exam_question_id');
    }

}
