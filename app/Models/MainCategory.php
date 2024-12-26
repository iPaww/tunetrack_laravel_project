<?php

namespace App\Models;

use App\Models\BaseModel;

class MainCategory extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';
    protected $fillable = [
        'name'
    ];
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
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
