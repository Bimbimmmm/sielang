<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExecutivePersonalData extends Model
{
    use HasFactory;
    protected $table = 'executive_personal_data';

    protected $casts = [
      'id' => 'string',
      ];

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'registration_number',
        'id_number',
        'birth_place',
        'birth_date',
        'gender',
        'position',
        'rank_id',
        'address',
        'province',
        'city',
        'district',
        'village',
        'zip_code'
    ];

    public function rank()
    {
      return $this->belongsTo('App\Models\ReferenceRanks', 'rank_id');
    }

    public function users()
    {
      return $this->hasMany('App\Models\User', 'id');
    }

}
