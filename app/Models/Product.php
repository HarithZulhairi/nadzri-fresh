<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'product_ID';
    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_category',
        'product_code',
        'product_price',
        'product_discount',
        'product_expiryDate',
        'product_status',
        'product_supplier',
        'product_waste',
        'product_picture_path'
    ];
}
