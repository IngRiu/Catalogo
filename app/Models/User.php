<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'admin_since'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin_since' => 'datetime',
    ];

    /**
    *The attributes that should be mutated to dates
    *
    *@var array
    */
    // protected $dates = [
    //     'admin_since',
    // ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Order::class, 'customer_id');
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function isAdmin()
    {
        return $this->admin_since != null
            && $this->admin_since->lessThanOrEqualTo(now());
    }

    public function setPasswordAtribute($password)
    {
        $this->attributes['password']=bcrypt($password);
    }
    public function getProfileImageAttribute()
    {
        return $this->image 
        ? "images/{$this->image->path}"
        : 'https://www.gravatar.com/avatar/404?d=mp';
    }
}
