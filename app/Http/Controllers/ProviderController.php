<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return view('admin.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.providers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:providers',
            'email' => 'required|email|string|max:255|unique:providers',
            'ruc_number' => 'required|string|max:11|unique:providers',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:9|unique:providers',
            'camera_type' => 'required|string|max:255', // Nuevo campo: Tipo de cámaras
            'origin_country' => 'required|string|max:255', // Nuevo campo: País de Origen
            'latin_american_countries' => 'required|string|max:255', // Nuevo campo: Países de Latinoamérica con oficinas
            'main_link' => 'required|url|max:255', // Nuevo campo: Link principal
        ]);

        Provider::create($request->all());
        return redirect()->route('providers.index')->with('success', 'Proveedor creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return view('admin.providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        return view('admin.providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:providers,name,' . $provider->id,
            'email' => 'required|email|string|max:255|unique:providers,email,' . $provider->id,
            'ruc_number' => 'required|string|max:11|unique:providers,ruc_number,' . $provider->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'required|string|max:9|unique:providers,phone,' . $provider->id,
            'camera_type' => 'required|string|max:255', // Nuevo campo: Tipo de cámaras
            'origin_country' => 'required|string|max:255', // Nuevo campo: País de Origen
            'latin_american_countries' => 'required|string|max:255', // Nuevo campo: Países de Latinoamérica con oficinas
            'main_link' => 'required|url|max:255', // Nuevo campo: Link principal
        ]);

        $provider->update($request->all());
        return redirect()->route('providers.index')->with('success', 'Proveedor actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('providers.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
