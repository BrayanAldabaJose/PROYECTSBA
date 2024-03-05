<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Sale;
use App\Models\Client; 
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::get();
        return view('admin.sale.index', compact('sales'));
    }
    
    public function create()
    {
        $clients = Client::get();
        return view('admin.sale.create', compact('clients'));
    }
    
    public function store(StoreSaleRequest $request)
    {
        $sale = Sale::create($request->all());

        // Itera a través de los productos y los vincula a la venta
        foreach ($request->product_id as $key => $product) {
            $sale->products()->attach($request->product_id[$key], [
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
            ]);
        }

        return redirect()->route('sales.index');
    }
    
    public function show(Sale $sale)
    {
        return view('admin.sale.show', compact('sale'));
    }
    
    public function edit(Sale $sale)
    {
        $clients = Client::get(); 
        return view('admin.sale.edit', compact('sale', 'clients'));
    }
    
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        // Actualiza los detalles de la venta
        $sale->update($request->all());

        // Desvincula los productos existentes para evitar duplicados
        $sale->products()->detach();

        // Itera a través de los productos actualizados y los vincula a la venta
        foreach ($request->product_id as $key => $product) {
            $sale->products()->attach($request->product_id[$key], [
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
            ]);
        }

        return redirect()->route('sales.index');
    }
    
    public function destroy(Sale $sale)
    {
        // Elimina la venta y los productos relacionados
        $sale->products()->detach();
        $sale->delete();

        return redirect()->route('sales.index');
    }
}
