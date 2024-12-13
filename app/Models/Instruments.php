<?php

namespace App\Models;

use App\Models\BaseModel;

class Instruments extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instrument_models';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'model_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
