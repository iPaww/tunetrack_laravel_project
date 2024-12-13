<?php

namespace App\Models;

use App\Models\BaseModel;

class Cart extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'cart_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
