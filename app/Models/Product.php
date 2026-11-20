<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'price', 
        'stock_quantity', 'purity', 'description', 'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class)->latest();
}

// Hàm hỗ trợ tính số sao trung bình của sản phẩm
public function averageRating()
{
    return round($this->reviews()->avg('rating'), 1) ?: 5.0;
}
}