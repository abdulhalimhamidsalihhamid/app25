<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'item_id', 'quantity'];

    // عنصر الطلبية يتبع طلبية واحدة
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // عنصر الطلبية يشير إلى منتج واحد
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
