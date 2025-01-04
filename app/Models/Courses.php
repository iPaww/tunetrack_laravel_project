<?php

namespace App\Models;

use App\Models\BaseModel;

class Courses extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courses';
    protected $fillable = [
        'name',
        'description',
        'objective',
        'trivia',
        'category_id',
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

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'course_id');
    }
}
