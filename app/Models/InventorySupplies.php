<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\BaseModel;

class InventorySupplies extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_supplies';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'serial_number',
        'product_id',
        'color_id',
    ];

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

    public function color(): HasOne
    {
        return $this->hasOne(\App\Models\Colors::class, 'id', 'color_id');
    }
}
