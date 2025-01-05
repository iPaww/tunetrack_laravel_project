<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

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
}
