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
        'sub_category_id',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    // Define the relationship to the Order model (assuming you have an Order model)
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
    
}
