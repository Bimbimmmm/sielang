<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;
    protected $table = 'indonesia_provinces';

    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'name',
        'meta'
    ];

}
