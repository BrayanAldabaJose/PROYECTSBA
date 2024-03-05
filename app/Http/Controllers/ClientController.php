<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $clients = Client::get();
    return view('admin.client.index', compact('clients'));
}

/**
 * Show the form for creating a new resource.
 */
public function create()
{
    return view('admin.client.create');
}

/**
 * Store a newly created resource in storage.
 */
public function store(StoreClientRequest $request)
{
    Client::create($request->all());
    return redirect()->route('clients.index');
}

/**
 * Display the specified resource.
 */
public function show(Client $client)
{
    return view('admin.client.show', compact('client'));
}

/**
 * Show the form for editing the specified resource.
 */
public function edit(Client $client)
{
    return view('admin.client.edit', compact('client'));
}

/**
 * Update the specified resource in storage.
 */
public function update(UpdateClientRequest $request, Client $client)
{
    $client->update($request->all());
    return redirect()->route('clients.index');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Client $client)
{
    $client->delete();
    return redirect()->route('clients.index');
}
}