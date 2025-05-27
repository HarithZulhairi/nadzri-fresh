<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'stock_ID';

    protected $fillable = [
        'product_ID',
        'stock_quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_ID', 'product_ID');
    }
}
