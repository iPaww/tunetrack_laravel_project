<?php

namespace App\Models;

use App\Models\BaseModel;

class TopicsUserHistory extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'topics_user_history';
    protected $fillable = [
        'topic_id',
        'user_id',
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
