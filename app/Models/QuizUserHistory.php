<?php

namespace App\Models;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    use SoftDeletes;

    public function quiz(): HasOne
    {
        return $this->belongsTo(\App\Models\Quiz::class, 'id', 'quiz_id');
    }

    public function course(): HasOne
    {
        return $this->belongsTo(\App\Models\Courses::class, 'id', 'course_id');
    }
}
