<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductPrice;

class ProductPriceController extends Controller
{
    // Función para mostrar una lista de precios de productos
    public function index()
    {
        $productPrices = ProductPrice::all();
        return view('product_prices.index', compact('productPrices'));
    }
    // Función para mostrar un precio de producto específico
    public function show(ProductPrice $productPrice)
    {
        return view('product_prices.show', compact('productPrice'));
    }


    // Función para almacenar un nuevo precio de producto
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'currency_id' => 'required|exists:currencies,id',
            'discount' => 'nullable|numeric|min:0|max:100',
            'tax_id' => 'nullable|exists:taxes,id',
        ]);

        ProductPrice::create($validatedData);

        return redirect()->back()->with('success', 'Precio de producto almacenado exitosamente.');
    }

    // Función para eliminar un precio de producto
    public function destroy(ProductPrice $productPrice)
    {
        $productPrice->delete();

        return redirect()->back()->with('success', 'Precio de producto eliminado exitosamente.');
    }

    // Función para actualizar un precio de producto
    public function update(Request $request, ProductPrice $productPrice)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'currency_id' => 'required|exists:currencies,id',
            'discount' => 'nullable|numeric|min:0|max:100',
            'tax_id' => 'nullable|exists:taxes,id',
        ]);

        $productPrice->update($validatedData);

        return redirect()->back()->with('success', 'Precio de producto actualizado exitosamente.');
    }
}
