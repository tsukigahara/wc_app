<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryData extends Model
{
    use HasFactory;

    protected $fillable = [
        'sign',
        'address',
        'note',
        'reference_name',
        'telephone',
        'email',
    ];
}
