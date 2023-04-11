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
        'pz_box'
    ];
}
