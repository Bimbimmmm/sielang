<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEnrolled extends Model
{
    use HasFactory;
    protected $table = 'student_enrolled';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'teaching_hour_id',
        'user_id',
        'is_active',
        'is_deleted'
    ];

    public function teachingHour()
    {
      return $this->belongsTo('App\Models\TeachingHour', 'teaching_hour_id');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

}
