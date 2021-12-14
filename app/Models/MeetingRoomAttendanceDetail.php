<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRoomAttendanceDetail extends Model
{
    use HasFactory;
    protected $table = 'meeting_room_attendance_detail';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'meeting_room_attendance_id',
        'user_id',
        'is_attend',
        'is_deleted'
    ];

    public function meetingRoomAttendance()
    {
      return $this->belongsTo('App\Models\MeetingRoomAttendance', 'meeting_room_attendance_id');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
