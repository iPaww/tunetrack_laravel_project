<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes; // SoftDeletes to handle deleted_at column

    // Define the table name (optional if it's plural form)
    protected $table = 'appointment';

    // Define the fillable attributes (columns that can be mass-assigned)
    protected $fillable = [
        'selected_date',
        'user_id',
        'sub_category_id',
        'status',
    ];

    // The attributes that should be mutated to dates.
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Define the relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class); // Assuming sub_category_id is related to SubCategory
    }
    
}
