<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingClass extends Model
{
    use HasFactory;
    protected $table = 'meeting_class';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'meeting_room_id',
        'link',
        'is_active',
        'is_deleted'
    ];

    protected $dates = [
      'start_date',
      'expired_date'
    ];

    public function meetingRoom()
    {
      return $this->belongsTo('App\Models\MeetingRoom', 'meeting_room_id');
    }
}
