<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Products::class, 'product_id', 'id');
    }

    public function product_review(): HasOne
    {
        return $this->hasOne(\App\Models\ProductReview::class, 'order_item_id', 'id');
    }

    public function inventoryProduct(): BelongsTo
    {
        return $this->belongsTo(\App\Models\InventoryProducts::class, 'inventory_id', 'id');}
    public function inventoryProductss()
    {
        return $this->hasMany(InventoryProducts::class, 'order_item_id', 'id');
    }
    public function InventoryProducts(): HasMany
    {
        return $this->hasMany(\App\Models\InventoryProducts::class, 'id', 'inventory_id');
    }

    public function inventorySupply(): BelongsTo
    {
        return $this->belongsTo(\App\Models\InventorySupplies::class, 'inventory_id', 'id');
    }

    public function InventorySupplies(): HasMany
    {
        return $this->hasMany(\App\Models\InventorySupplies::class, 'id', 'inventory_id');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id'); // Assuming 'order_id' is the foreign key in 'orders_item' table
    }
    public function appointment()
    {
        return $this->hasOne(Appointment::class, 'order_id', 'order_id');
    }
    public function color(): BelongsTo
    {
        return $this->belongsTo(Colors::class, 'color_id', 'id');
    }
    



}
