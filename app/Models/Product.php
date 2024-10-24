<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
        'user_id', // Add this line
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product belongs to a user (seller)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
