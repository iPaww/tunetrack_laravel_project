<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\BaseModel;

class OrderItems extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders_item';

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
      * Disable the created_at and updated_at column
      */
      public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'inventory_id',
        'order_id',
        'quantity',
        'price',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(\App\Models\Products::class, 'id', 'product_id');
    }

    public function product_review(): HasOne
    {
        return $this->hasOne(\App\Models\ProductReview::class, 'order_item_id', 'id');
    }

    public function InventoryProduct(): HasOne
    {
        return $this->hasOne(\App\Models\InventoryProducts::class, 'id', 'inventory_id');
    }

    public function InventoryProducts(): HasMany
    {
        return $this->hasMany(\App\Models\InventoryProducts::class, 'id', 'inventory_id');
    }

    public function InventorySupply(): HasOne
    {
        return $this->hasOne(\App\Models\InventorySupplies::class, 'id', 'inventory_id');
    }

    public function InventorySupplies(): HasMany
    {
        return $this->hasMany(\App\Models\InventorySupplies::class, 'id', 'inventory_id');
    }

    public function order()
{
    return $this->belongsTo(Orders::class, 'order_id', 'id'); // Assuming 'order_id' is the foreign key in 'orders_item' table
}

   
}
