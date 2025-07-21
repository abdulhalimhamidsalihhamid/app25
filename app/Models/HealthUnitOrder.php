<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthUnitOrder extends Model
{
     protected $fillable = ['order_id', 'user_id', 'status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
