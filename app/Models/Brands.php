<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brands extends Model
{

    protected $fillable = [
        'name',
    ];

    protected $dates = ['deleted_at'];
    use SoftDeletes;
}
