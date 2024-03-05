<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saleDetail extends Model
{
    use HasFactory;
    protected $fillable = [
    'sale_id',
    'product_id',
    'quantity',
    'price',
    'discount',
    ];
    public function products(){
        return $this-> belongsTo(Product::class);
    }
}
