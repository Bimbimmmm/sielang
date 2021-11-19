<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassExamQuestion extends Model
{
    use HasFactory;
    protected $table = 'meeting_exam_question';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'meeting_exam_id',
        'question',
        'question_file',
        'is_multiple_choice',
        'is_deleted'
    ];

    public function meetingExam()
    {
      return $this->belongsTo('App\Models\MeetingExam', 'meeting_exam_id');
    }

    public function ClassExamChoice()
    {
      return $this->hasMany('App\Models\ClassExamChoice', 'id');
    }
}
