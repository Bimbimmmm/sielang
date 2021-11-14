<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceReligions extends Model
{
    use HasFactory;
    protected $table = 'reference_religions';

    protected $primaryKey = "id";

    protected $fillable = [
        'name'
    ];

    public function teacherpersonalDatas()
    {
      return $this->hasMany('App\Models\TeacherPersonalData', 'id');
    }
}
