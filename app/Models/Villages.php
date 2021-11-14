<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villages extends Model
{
    use HasFactory;
    protected $table = 'indonesia_villages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'district_code',
        'name',
        'meta'
    ];
}
