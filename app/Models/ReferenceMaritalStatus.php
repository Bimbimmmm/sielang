<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceMaritalStatus extends Model
{
    use HasFactory;
    protected $table = 'reference_marital_status';

    protected $primaryKey = "id";

    protected $fillable = [
        'name'
    ];

    public function teacherpersonalDatas()
    {
      return $this->hasMany('App\Models\TeacherPersonalData', 'id');
    }
}
