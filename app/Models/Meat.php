<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class Meat extends Product
{
    use HasFactory;

    protected $fillable = [
        'unit',
        'average_size',
        'pz_box',
        'purchase_price',
        'b2b_price',
        'b2b_percentage',
        'b2d_price',
        'b2d_percentage',
        'b2c_price',
        'b2c_percentage',
    ];
}
