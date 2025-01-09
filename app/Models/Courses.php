<?php

namespace App\Models;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public function quizes(): HasMany
    {
        return $this->hasMany(Quiz::class, 'course_id');
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topics::class, 'course_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
