<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'appointment';

    protected $fillable = [
        'selected_date',
        'user_id',
        'order_id',
        'status',
        'product_id',
        'teacher_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    // Define the relationship to the Order model (assuming you have san Order model)
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'appointment_id', 'id'); // Assuming orders have an appointment_id
    }

    // Define the relationship to the OrderItems model via the Order model
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id'); // Correct relationship to order_items
    }
    public function appointment()
    {
        // Access appointment via the related order
        return $this->hasOneThrough(
            Appointment::class,
            Orders::class,
            'id', // Foreign key on orders table
            'order_id', // Foreign key on appointments table
            'order_id', // Local key on order_items table
            'id' // Local key on orders table
        );
    }
    public function users()
{
    return $this->belongsTo(User::class);
}

public function product()
{
    return $this->belongsTo(Products::class);
}
}
