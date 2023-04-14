<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'shorthand',
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
