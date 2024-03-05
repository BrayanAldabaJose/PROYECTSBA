<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Nombre correcto de la tabla en la base de datos

    protected $fillable = [
        'name', // Campos que se pueden llenar de forma masiva
        'description',
    ];

    // Relaciones con otros modelos
    public function products()
    {
        return $this->hasMany(Product::class); // Una categoría tiene muchos productos
    }

    // Otros métodos, si es necesario
}

