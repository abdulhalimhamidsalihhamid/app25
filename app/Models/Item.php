<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // الحقول التي يسمح بالكتابة فيها
    protected $fillable = [
        'name',
        'description',
        'sub_product_id',
    ];

    /**
     * علاقة المنتج مع القسم الفرعي (SubProduct)
     * كل منتج يتبع قسم فرعي واحد
     */
    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_id');
    }
public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}


    /**
     * علاقة المنتج مع معلومات المنتج (infos)
     * منتج واحد يمكن أن يملك عدة سجلات معلومات (عادة واحدة فقط في حالتك)
     */
    public function infos()
    {
        return $this->hasMany(ItemInfo::class, 'item_id');
    }
}
