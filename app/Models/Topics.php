<?php

namespace App\Models;

use App\Models\BaseModel;

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

    /**
     * Define the relationship between Topics and SubCategory.
     *
     * This assumes sub_category_id is a foreign key to sub_category.
     */
    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
    }
}
