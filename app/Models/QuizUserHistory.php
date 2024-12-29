<?php

namespace App\Models;

use App\Models\BaseModel;

class QuizUserHistory extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quiz_user_history';
    protected $fillable = [
        'answer',
        'quiz_id',
        'course_id',
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
