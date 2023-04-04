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
    ];
}
