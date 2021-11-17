<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{
    use HasFactory;
    protected $table = 'meeting_room';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'teaching_hour_id',
        'year',
        'is_active',
        'is_deleted'
    ];

    protected $dates = [
      'start_date',
      'expired_date'
    ];

    public function teachingHour()
    {
      return $this->belongsTo('App\Models\TeachingHour', 'teaching_hour_id');
    }

    public function meetingClass()
    {
      return $this->hasMany('App\Models\MeetingClass', 'id');
    }
}
