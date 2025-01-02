<?php

namespace App\Models;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Model;

class sub_category extends BaseModel
{
    protected $table = 'sub_category';
    protected $fillable = [
        'name',
        'category_id'
    ];
    protected $primaryKey = 'id';
    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    /**
      * Disable the created_at and updated_at column
      */
      public $timestamps = false;
}
