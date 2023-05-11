<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BMS extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'value',
    ];

    public function meats()
    {
        return $this->hasMany(Meat::class);
    }
}
