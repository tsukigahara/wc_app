<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'referent_name',
        'telephone',
        'emai',
    ];

    //polimorphic many
    public function meats()
    {
        return $this->morphedByMany(Meat::class, 'supplierable');
    }
}
