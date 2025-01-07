<?php

namespace App\Models;

use App\Models\BaseModel;

class Orders extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_method',
        'status',
        'total',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function orderItems()
{
    return $this->hasMany(OrderItems::class, 'order_id', 'id'); // Assuming the order_id field is the foreign key
}
public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
