<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Product;

class ReservationController extends Controller
{
    public function create($productId)
    {
        // Obtener los detalles del producto desde la base de datos
        $product = Product::findOrFail($productId);

        // Aquí puedes mostrar un formulario con los detalles del producto para que los usuarios puedan hacer una reserva
        return view('shoplive.create', compact('product'));
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'reservation_date' => 'required|date',
            'details' => 'required|array|min:1', // Verifica que haya al menos un detalle
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            // Crea una nueva reserva en la base de datos
            $reservation = Reservation::create([
                'user_id' => $request->user_id,
                'reservation_date' => $request->reservation_date,
            ]);

            // Guarda los detalles de la reserva
            foreach ($request->details as $detail) {
                // Obtener el producto
                $product = Product::findOrFail($detail['product_id']);

                // Obtener el precio unitario del producto
                $unitPrice = $product->prices()->first()->unit_price;

                // Calcular el precio total del detalle (precio unitario * cantidad)
                $totalPrice = $unitPrice * $detail['quantity'];

                ReservationDetail::create([
                    'reservation_id' => $reservation->id,
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['quantity'],
                    'price' => $totalPrice, // Usando el precio total calculado
                ]);
            }

            // Redirige al usuario a alguna página después de hacer la reserva
            return redirect()->route('ruta.deseada')->with('success', '¡Reserva realizada exitosamente!');
        } catch (\Exception $e) {
            // Si ocurre algún error, redirige de vuelta con un mensaje de error
            return redirect()->back()->with('error', 'Ha ocurrido un error al procesar la reserva. Por favor, inténtelo de nuevo.');
        }
    }
}
