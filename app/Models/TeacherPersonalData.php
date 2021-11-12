<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherPersonalData extends Model
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
        'educator_number',
        'birth_place',
        'gender',
        'marital_status_id',
        'religion_id',
        'rank_id',
        'school_id',
        'position_id',
        'status_id',
        'education_id',
        'tax_number',
        'teacher_type',
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

  public function maritalStatus()
  {
    return $this->belongsTo('App\Models\ReferenceMaritalStatus', 'marital_status_id');
  }

  public function religion()
  {
    return $this->belongsTo('App\Models\ReferenceReligions', 'religion_id');
  }

  public function rank()
  {
    return $this->belongsTo('App\Models\ReferenceRanks', 'rank_id');
  }

  public function school()
  {
    return $this->belongsTo('App\Models\ReferenceSchools', 'school_id');
  }

  public function position()
  {
    return $this->belongsTo('App\Models\ReferencePositions', 'position_id');
  }

  public function status()
  {
    return $this->belongsTo('App\Models\ReferenceStatus', 'status_id');
  }

  public function education()
  {
    return $this->belongsTo('App\Models\ReferenceEducations', 'education_id');
  }

  public function users()
  {
    return $this->hasMany('App\Models\User', 'id');
  }
}
