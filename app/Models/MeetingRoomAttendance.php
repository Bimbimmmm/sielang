<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRoomAttendance extends Model
{
    use HasFactory;
    protected $table = 'meeting_room_attendance';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'meeting_room_id',
        'is_finish',
        'is_deleted'
    ];

    public function meetingRoom()
    {
      return $this->belongsTo('App\Models\MeetingRoom', 'meeting_room_id');
    }

    public function meetingRoomAttendanceDetail()
    {
      return $this->hasMany('App\Models\MeetingRoomAttendanceDetail', 'id');
    }

}
