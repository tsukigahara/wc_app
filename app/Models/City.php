<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function delivery_data()
    {
        return $this->hasMany(DeliveryData::class);
    }
}
