<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    /** @use HasFactory<\Database\Factories\OutletFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'maps',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
