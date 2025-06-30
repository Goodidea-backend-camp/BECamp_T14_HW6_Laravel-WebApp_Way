<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'store_id',
        'create_user_id',
        'created_at',
        'end_at',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
