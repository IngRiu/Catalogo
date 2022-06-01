<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'customer_id',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }
}
