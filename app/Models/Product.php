<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'initial_stock',
        'current_stock',
        'last_stock_change',
        'status',
        'category_id',
        'provider_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sales()
    {
        return $this->hasMany(ProductSale::class);
    }

    public function stockChanges()
    {
        return $this->hasMany(StockChange::class);
    }
}
