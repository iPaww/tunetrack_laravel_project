<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topics extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'topics';
    protected $fillable = [
        'title',
        'description',
        'image',
        'audio',
        'course_id',
        'sub_category_id',
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
    /**
     * Define the relationship between Topics and SubCategory.
     *
     * This assumes sub_category_id is a foreign key to sub_category.
     */
      // Define the relationship with Courses
      public function courses()
      {
          return $this->belongsTo(Courses::class, 'course_id', 'id');
      }
    public function course()
{
    return $this->belongsTo('App\Models\Course', 'course_id', 'id');
}

}
