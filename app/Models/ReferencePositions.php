<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferencePositions extends Model
{
    use HasFactory;
    protected $table = 'reference_positions';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'is_functional',
        'echelon'
    ];

    public function teacherpersonalDatas()
    {
      return $this->hasMany('App\Models\TeacherPersonalData', 'id');
    }
}
