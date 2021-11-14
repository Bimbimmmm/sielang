<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceRanks extends Model
{
    use HasFactory;
    protected $table = 'reference_ranks';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'group',
        'rank'
    ];

    public function teacherpersonalDatas()
    {
      return $this->hasMany('App\Models\TeacherPersonalData', 'id');
    }
}
