<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentPersonalData extends Model
{
    use HasFactory;
    protected $table = 'parent_personal_data';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'id_number',
        'student_personal_data_id',
        'birth_date',
        'birth_place',
        'gender',
        'religion_id',
        'phone_number',
        'address',
        'province',
        'city',
        'district',
        'village',
        'zip_code'
    ];

    public function religion()
    {
      return $this->belongsTo('App\Models\ReferenceReligions', 'religion_id');
    }

    public function student()
    {
      return $this->belongsTo('App\Models\StudentPersonalData', 'student_personal_data_id');
    }

    public function users()
    {
      return $this->hasMany('App\Models\User', 'id');
    }

}
