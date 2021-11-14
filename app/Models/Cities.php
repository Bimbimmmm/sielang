<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $table = 'indonesia_cities';

    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'province_code',
        'name',
        'meta'
    ];
}
