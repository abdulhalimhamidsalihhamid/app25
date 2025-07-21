<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_date'];

    // كل طلبية تتبع مستخدم واحد
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // كل طلبية تحتوي على عناصر متعددة
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
