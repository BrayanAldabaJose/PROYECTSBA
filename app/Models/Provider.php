<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'ruc_number',
        'address',
        'phone',
        'camera_type', // Nuevo campo: Tipo de cámaras
        'origin_country', // Nuevo campo: País de Origen
        'latin_american_countries', // Nuevo campo: Países de Latinoamérica con oficinas
        'main_link', // Nuevo campo: Link principal
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
