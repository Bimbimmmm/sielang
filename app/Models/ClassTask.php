<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTask extends Model
{
    use HasFactory;
    protected $table = 'meeting_task';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'teaching_hour_id',
        'task_instructions',
        'file',
        'is_active',
        'is_deleted'
    ];

    protected $dates = [
      'start_date',
      'expired_date',
    ];

    public function teachingHour()
    {
      return $this->belongsTo('App\Models\TeachingHour', 'teaching_hour_id');
    }

    public function classTaskCollection()
    {
      return $this->hasMany('App\Models\ClassTaskCollection', 'id');
    }
}
