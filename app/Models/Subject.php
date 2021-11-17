<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subject';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'is_compulsory',
        'school_id',
        'is_deleted'
    ];

    public function school()
    {
      return $this->belongsTo('App\Models\ReferenceSchools', 'school_id');
    }

    public function teachingHour()
    {
      return $this->hasMany('App\Models\TeachingHour', 'id');
    }
}
