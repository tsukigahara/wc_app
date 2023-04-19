<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'ragione_sociale',
        'partita_iva',
        'codice_fiscale',
        'sdi',
        'pec',
        'sede_legale',
        'city',
    ];

    public function delivery_data()
    {
        return $this->hasMany(DeliveryData::class);
    }

    public function client_type()
    {
        return $this->belongsTo(ClientType::class);
    }

    public function pricing_type()
    {
        return $this->belongsTo(PricingType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
