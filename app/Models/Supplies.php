<?php

namespace App\Models;

use App\Models\BaseModel;

class Supplies extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'supplies';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'supply_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
