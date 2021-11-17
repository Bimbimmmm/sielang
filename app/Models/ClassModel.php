<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'major',
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
