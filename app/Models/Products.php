<?php

namespace App\Models;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'category_id',
        'sub_category_id',
        'product_type_id',
        'brand_id',
        'products_type',
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;
    use SoftDeletes;

    public function product()
        {
            return $this->belongsTo(Products::class);
        }
    // Relationship with categories (make sure it's singular "category")
    public function category(): BelongsTo
    {
        return $this->belongsTo(MainCategory::class, 'category_id');
    }

    // Relationship with subcategories
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    // Relationship with product types
    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    // Relationship with brands
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function type(): HasOne
    {
        return $this->hasOne(ProductType::class, 'id', 'product_type_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'product_id');
    }
}
