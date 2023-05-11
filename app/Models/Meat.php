<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class Meat extends Product
{
    use HasFactory;

    protected $fillable = [
        'name',
        'average_weight',
        'pz_box',

        //uguale per tutti i prodotti
        'purchase_price',
        'b2b_price',
        'b2b_percentage',
        'b2d_price',
        'b2d_percentage',
        'b2c_price',
        'b2c_percentage',
    ];

    public function BMS()
    {
        return $this->belongsTo(BMS::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function meatSubnames()
    {
        return $this->belongsToMany(MeatSubname::class);
    }

    //polimorphic many
    public function suppliers()
    {
        return $this->morphToMany(Supplier::class, 'supplierable');
    }

    //polimorphic 1to1
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
