<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Purchase;
use App\Models\Provider;

class PurchaseController extends Controller
{
    /**
     * Muestra una lista de los recursos.
     */
    public function index()
    {
        $purchases = Purchase::get();
        return view('admin.purchase.index', compact('purchases'));
    }
    
    public function create()
    {
        $providers = Provider::get();
        return view('admin.purchase.create', compact('providers'));
    }
    
    public function store(StorePurchaseRequest $request)
    {
        $purchase = Purchase::create($request->all());

        // Itera a través de los productos y los vincula a la compra
        foreach ($request->product_id as $key => $product) {
            $purchase->products()->attach($request->product_id[$key], [
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
            ]);
        }

        return redirect()->route('purchases.index');
    }
    
    public function show(Purchase $purchase)
    {
        return view('admin.purchase.show', compact('purchase'));
    }
    
    public function edit(Purchase $purchase)
    {
        $providers = Provider::get();
        return view('admin.purchase.edit', compact('purchase', 'providers'));
    }
    
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        // Actualiza los detalles de la compra
        $purchase->update($request->all());

        // Desvincula los productos existentes para evitar duplicados
        $purchase->products()->detach();

        // Itera a través de los productos actualizados y los vincula a la compra
        foreach ($request->product_id as $key => $product) {
            $purchase->products()->attach($request->product_id[$key], [
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
            ]);
        }

        return redirect()->route('purchases.index');
    }
    
    public function destroy(Purchase $purchase)
    {
        // Elimina la compra y los productos relacionados
        $purchase->products()->detach();
        $purchase->delete();

        return redirect()->route('purchases.index');
    }
}
