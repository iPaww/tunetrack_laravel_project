<?php

namespace App\Models;

use App\Models\BaseModel;

class Categories extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';
    protected $fillable = [
        'name', // Add other fields that you want to allow for mass assignment
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
}
