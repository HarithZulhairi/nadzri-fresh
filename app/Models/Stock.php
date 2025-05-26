<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'max_quantity',
        'expiration_date',
        'category',
        'price',
        'supplier',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_ID');
    }
}
