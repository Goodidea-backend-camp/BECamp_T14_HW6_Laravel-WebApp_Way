<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'description',
    ];

    public function menu()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'store_id', 'id');
    }
}
