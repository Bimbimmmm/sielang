<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $table = 'indonesia_districts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'city_code',
        'name',
        'meta'
    ];
}
