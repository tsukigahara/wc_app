<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_price',
        'b2b_price',
        'b2b_percentage',
        'b2d_price',
        'b2d_percentage',
        'b2c_price',
        'b2c_percentage',
    ];
}
