<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'percentage',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
