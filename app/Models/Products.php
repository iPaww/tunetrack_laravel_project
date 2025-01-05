<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Products extends BaseModel
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

    // Correct relationship method (singular "category")
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }
}