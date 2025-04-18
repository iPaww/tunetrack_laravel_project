<?php

namespace App\Models;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends BaseModel
{
    protected $table = 'sub_category';
    protected $fillable = [
        'name',
        'category_id',
    ];
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Disable the created_at and updated_at columns
     */
    public $timestamps = false;

    /**
     * Define relationship to MainCategory
     */
    public function mainCategory()
    {
        return $this->belongsTo('App\Models\MainCategory', 'category_id', 'id');
    }
}