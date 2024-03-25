<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;

class ProductImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verificar si se han enviado imágenes en la solicitud
        if ($request->hasFile('image')) {
            // Procesar y almacenar cada imagen recibida
            foreach ($request->file('image') as $image) {
                $path = $image->store('product_images');


                // Crear una nueva instancia de ProductImage
                $productImage = new ProductImage([
                    'product_id' => $request->product_id,
                    'image_path' => $path,
                ]);

                // Guardar la instancia en la base de datos
                $productImage->save();
            }
        }

        // Redireccionar o devolver una respuesta JSON, según sea necesario
    }


    public function edit(ProductImage $productImage)
    {
        // Retornar la vista de edición con los datos del producto de imagen
        return view('admin.product_images.edit', compact('productImage'));
    }

    public function update(Request $request, ProductImage $productImage)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar la actualización de la imagen, si se proporciona una nueva imagen
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Eliminar la imagen anterior del sistema de archivos
            Storage::delete($productImage->image_path);

            // Almacenar la nueva imagen
            $path = $request->file('image')->store('product_images');

            // Actualizar la ruta de la imagen en la base de datos
            $productImage->image_path = $path;
            $productImage->save();
        }

        // Redireccionar o devolver una respuesta JSON, según sea necesario
    }
    public function show(ProductImage $productImage)
    {
        // Retornar la vista de detalle de la imagen del producto
        return view('admin.product_images.show', compact('productImage'));
    }

    public function destroy(ProductImage $productImage)
    {
        // Eliminar la imagen de la base de datos y del sistema de archivos
        $productImage->delete();

        // Redireccionar o devolver una respuesta JSON, según sea necesario
    }
}
