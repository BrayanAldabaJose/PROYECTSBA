<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'product_id', 'total_price', 'unit_price', 'currency_id', 'discount', 'tax_id', 'base_price'
    ];
    /**
     * Get the product associated with the product price.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the currency associated with the product price.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the tax associated with the product price.
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
}
