<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceSchools extends Model
{
    use HasFactory;
    protected $table = 'reference_schools';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'national_school_number',
        'is_public',
        'address',
        'province',
        'city',
        'district',
        'village',
        'zip_code',
        'is_deleted'
    ];

    public function teacherpersonalDatas()
    {
      return $this->hasMany('App\Models\TeacherPersonalData', 'id');
    }

    public function studentpersonalDatas()
    {
      return $this->hasMany('App\Models\StudentPersonalData', 'id');
    }
}
