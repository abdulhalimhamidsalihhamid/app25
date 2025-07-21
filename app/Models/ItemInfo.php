<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInfo extends Model
{
    protected $fillable = ['item_id', 'quantity', 'expire_date'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

}
