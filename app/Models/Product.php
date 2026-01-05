<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'description',
    'price',
    'image',
    'category',
    'stock',
];
protected static function booted()
{
    static::creating(function ($product) {
        if (empty($product->image)) {
            $product->image = 'default.png';
        }
    });
}


}
