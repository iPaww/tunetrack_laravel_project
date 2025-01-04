<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

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
     * Get the comments for the blog post.
     */
    public function supplies(): HasMany
    {
        return $this->hasMany(InventorySupplies::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function products(): HasMany
    {
        return $this->hasMany(InventoryProducts::class);
    }
}
