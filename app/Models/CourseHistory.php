<?php

namespace App\Models;

use App\Models\BaseModel;

class CourseHistory extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courses_user_history';
    protected $fillable = [
        'completion',
        'start_date',
        'user_id',
        'course_id',
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
