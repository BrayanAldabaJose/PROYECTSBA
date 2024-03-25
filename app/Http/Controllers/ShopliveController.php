<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;
use App\Models\Currency;
use App\Models\ProductImg;
use App\Models\ProductPrice;


class ShopliveController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Obtener los productos desde el modelo Product
        return view('shoplive.index', compact('products')); // Pasar los productos a la vista
    }
}
