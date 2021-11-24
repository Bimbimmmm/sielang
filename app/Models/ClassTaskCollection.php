<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTaskCollection extends Model
{
    use HasFactory;
    protected $table = 'meeting_task_collection';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'meeting_task_id',
        'user_id',
        'file',
        'score',
        'is_deleted'
    ];

    public function meetingTask()
    {
      return $this->belongsTo('App\Models\MeetingTask', 'meeting_task_id');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
