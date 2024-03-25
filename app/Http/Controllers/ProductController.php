<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;
use App\Models\Currency;
use App\Models\ProductImage;
use App\Models\ProductPrice;
use App\Models\Tax;
use App\Http\Controllers\ProductImageController;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $providers = Provider::all();
        $currencies = Currency::all();
        $taxes = Tax::all();
        $product = new Product(); // Crear un nuevo objeto Product
        return view('admin.products.create', compact('categories', 'providers', 'currencies', 'taxes', 'product'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:products',
            'description' => 'nullable|string',
            'initial_stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
            'currency_id' => 'required|exists:currencies,id',
            'base_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'current_stock' => 'required|integer|min:0',
            'tax_id' => 'required|exists:taxes,id',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Obtener los datos de moneda, impuesto y descuento
        $currency = Currency::findOrFail($request->currency_id);
        $tax = Tax::findOrFail($request->tax_id);
        $discountValue = $request->discount ?? 0;

        // Calcular el precio unitario
        $basePrice = $request->base_price;
        $discount = $request->discount ?? 0;
        $taxRate = $tax->rate;
        $unitPrice = $basePrice * (1 + $taxRate / 100) * (1 - $discount / 100);
        $stock = $request->initial_stock;
        $amount = $unitPrice * $stock;

        // Procesar la imagen si está presente en la solicitud
        if ($request->hasFile('images')) {
            // Verificar si hay errores al cargar la imagen
            if ($request->file('images')->isValid()) {
                // Obtener el archivo de imagen del formulario
                $image = $request->file('images');

                // Guardar la imagen en el sistema de archivos
                $path = $image->store('product_images');

                // Crear el producto junto con el registro de imagen
                $product = Product::create([
                    'name' => $request->name,
                    'code' => $request->code,
                    'description' => $request->description,
                    'initial_stock' => $request->initial_stock,
                    'category_id' => $request->category_id,
                    'provider_id' => $request->provider_id,
                    'currency_id' => $request->currency_id,
                    'base_price' => $request->base_price,
                    'discount' => $request->discount,
                    'current_stock' => $request->current_stock,
                    'tax_id' => $request->tax_id,
                    'amount' => $amount,
                    'unit_price' => $unitPrice,
                ]);

                // Crear el registro de ProductPrice
                $productPriceData = [
                    'amount' => $amount,
                    'unit_price' => $unitPrice,
                    'discount' => $discountValue,
                    'currency_id' => $request->currency_id,
                    'currency_name' => $currency->name,
                    'currency_symbol' => $currency->symbol,
                    'tax_id' => $request->tax_id,
                    'tax_name' => $tax->name,
                    'tax_symbol' => $tax->symbol,
                    'base_price' => $basePrice,
                ];
                $product->prices()->create($productPriceData);

                // Crear el registro de ProductImg asociado al producto
                $productImg = new ProductImage();
                $productImg->product_id = $product->id; // Asegúrate de tener el producto disponible aquí
                $productImg->image_path = $path;
                $productImg->save();
            } else {
                // Agrega un mensaje de error si la imagen no es válida
                return redirect()->back()->withInput()->withErrors(['image' => 'Hubo un error al cargar la imagen.']);
            }
        }
        $productImageController = new ProductImageController();
        $productImageController->store($request);


        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        $providers = Provider::all();
        $currencies = Currency::all();
        $taxes = Tax::all();
        return view('admin.products.edit', compact('product', 'categories', 'providers', 'currencies', 'taxes'));
    }

    // Método para actualizar un producto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:products,code,' . $product->id,
            'description' => 'nullable|string',
            'initial_stock' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
            'tax_id' => 'required|exists:taxes,id',
            'currency_id' => 'required|exists:currencies,id',
            'discount' => 'nullable|numeric|min:0|max:100',
            'amount' => 'required|numeric|min:0', // Asegúrate de incluir 'amount' en la validación
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para las imágenes
            'current_stock' => 'required|integer|min:0', // Validación para el stock actual
        ]);

        // Obtener los datos de moneda, impuesto y descuento
        $currency = Currency::findOrFail($request->currency_id);
        $tax = Tax::findOrFail($request->tax_id);
        $discountValue = $request->discount ?? 0;

        // Calcular el precio unitario
        $basePrice = $request->unit_price;
        $discount = $request->discount ?? 0;
        $taxRate = $tax->rate;
        $unitPrice = $basePrice * (1 + $taxRate / 100) * (1 - $discount / 100);
        $stock = $request->initial_stock;
        $amount = $unitPrice * $stock;

        // Actualizar el producto
        $product->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'initial_stock' => $request->initial_stock,
            'category_id' => $request->category_id,
            'provider_id' => $request->provider_id,
            'currency_id' => $request->currency_id,
            'base_price' => $basePrice,
            'discount' => $request->discount,
            'current_stock' => $request->current_stock,
            'tax_id' => $request->tax_id,
            'amount' => $amount,
            'unit_price' => $unitPrice,
        ]);

        // Procesar las imágenes si están presentes en la solicitud
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Verificar si hay errores al cargar la imagen
                if ($image->isValid()) {
                    // Guardar la imagen en el sistema de archivos
                    $path = $image->store('product_images');

                    // Crear el registro de ProductImg asociado al producto
                    $productImg = new ProductImage();
                    $productImg->product_id = $product->id;
                    $productImg->image_path = $path;
                    $productImg->save();
                } else {
                    // Agregar un mensaje de error si alguna imagen no es válida
                    return redirect()->back()->withInput()->withErrors(['image' => 'Hubo un error al cargar una de las imágenes.']);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        $product->delete();


        // Redirigir con un mensaje de éxito
        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');
    }
}

