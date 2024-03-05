<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Provider;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); // Asegúrate de importar el modelo Category al principio del archivo
        $providers = Provider::all(); // Asegúrate de importar el modelo Provider al principio del archivo
        return view('admin.products.create', compact('categories', 'providers'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'code' => 'required|string|max:255|unique:products',
            'stock' => 'required|integer',
            'sell_price' => 'required|numeric',
            'status' => 'required|in:ACTIVE,DEACTIVATED',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // validación para la imagen
        ]);

        // Procesar y guardar la imagen
        $imagePath = $request->file('image')->store('product_images', 'public');

        $product = Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'stock' => $request->stock,
            'sell_price' => $request->sell_price,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'provider_id' => $request->provider_id,
            'image' => $imagePath, // guardamos la ruta de la imagen en la base de datos
        ]);

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'code' => 'required|string|max:255|unique:products,code,' . $product->id,
            'stock' => 'required|integer',
            'sell_price' => 'required|numeric',
            'status' => 'required|in:ACTIVE,DEACTIVATED',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validación para la imagen (opcional)
        ]);

        // Actualizar los datos del producto
        $product->update($request->all());

        // Si se proporciona una nueva imagen, actualizarla
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
