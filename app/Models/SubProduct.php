<?php

// app/Models/SubProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{

    protected $fillable = [
        'product_id',
        'name',
        'description',
    ];

    public function parent()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function items()
{
    return $this->hasMany(Item::class, 'sub_product_id');
}
public function productCategory()
{
    return $this->belongsTo(Product::class, 'product_id');
}

}
