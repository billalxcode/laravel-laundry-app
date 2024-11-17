<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'outlet_id',
        'user_id',
        'status',
        'total_price',
    ];

    public function outlet()
    {
        return $this->hasOne(Outlet::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
