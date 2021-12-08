<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassExamCollection extends Model
{
    use HasFactory;
    protected $table = 'meeting_exam_collection';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'meeting_exam',
        'user_id',
        'multiple_choice_score',
        'essay_score',
        'total_score',
        'is_finished',
        'is_scored',
        'is_deleted'
    ];

    public function meetingExam()
    {
      return $this->belongsTo('App\Models\ClassExam', 'meeting_exam_id');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function classExamCollectionAnswer()
    {
      return $this->hasMany('App\Models\ClassExamCollectionAnswer', 'id');
    }

}
