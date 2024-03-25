<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'country',
        'exchange_rate',
        'origin_country',
    ];


    // Puedes definir relaciones con otros modelos aquí si es necesario
}
