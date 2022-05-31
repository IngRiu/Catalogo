<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'Title',
        'Description',
        'Price',
        'Stock',
        'Status',
    ];
    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
