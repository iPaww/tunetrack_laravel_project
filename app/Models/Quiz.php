<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quiz';
    protected $fillable = [
        'question',
        'a_answer',
        'b_answer',
        'c_answer',
        'd_answer',
        'correct_answer',
        'question_order',
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
    use SoftDeletes;

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
