<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPersonalData extends Model
{
    use HasFactory;

    protected $table = 'personal_datas';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'registration_number',
        'id_number',
        'student_number',
        'national_student_number',
        'birth_date',
        'birth_place',
        'gender',
        'religion_id',
        'school_id',
        'address',
        'province',
        'city',
        'district',
        'village',
        'zip_code'
    ];

    protected $dates = [
      'birth_date',
      'cs_year',
      'cs_candidate_year'
  ];


  public function religion()
  {
    return $this->belongsTo('App\Models\ReferenceReligions', 'religion_id');
  }

  public function school()
  {
    return $this->belongsTo('App\Models\ReferenceSchools', 'school_id');
  }

  public function users()
  {
    return $this->hasMany('App\Models\User', 'id');
  }
}
