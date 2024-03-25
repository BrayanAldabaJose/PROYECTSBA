<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationDetail;

class ReservationDetailController extends Controller
{
    public function create()
    {
        // Aquí puedes mostrar un formulario para que los usuarios puedan agregar detalles a una reserva
        return view('reservation_details.create');
    }
public function store(Request $request)
{
    // Valida los datos del formulario
    $request->validate([
        'reservation_id' => 'required|exists:reservations,id',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0', // Nuevo campo 'price' requerido y numérico
    ]);

    // Obtener el producto
    $product = Product::findOrFail($request->product_id);

    // Obtener el precio unitario del producto
    $unitPrice = $product->price; // Asumiendo que el precio unitario está almacenado en el modelo de producto

    // Calcular el precio total del detalle (precio unitario * cantidad)
    $totalPrice = $unitPrice * $request->quantity;

    // Crea un nuevo detalle de reserva en la base de datos
    ReservationDetail::create([
        'reservation_id' => $request->reservation_id,
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'price' => $totalPrice, // Utiliza el precio total calculado
    ]);

    // Redirige al usuario a alguna página después de agregar el detalle de la reserva
    return redirect()->route('ruta.deseada');
}
}
