<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonResult extends Model
{
    use HasFactory;
    protected $table = 'lesson_result';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'teaching_hour_id',
        'is_deleted'
    ];

    public function teachingHour()
    {
      return $this->belongsTo('App\Models\TeachingHour', 'teaching_hour_id');
    }

    public function LessonResultDetail()
    {
      return $this->hasMany('App\Models\LessonResultDetail', 'id');
    }
}
