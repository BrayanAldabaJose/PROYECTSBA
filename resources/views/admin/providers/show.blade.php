@extends('adminlte::page')

@section('title', 'Detalles del Proveedor')

@section('content_header')
    <h1>Detalles del Proveedor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nombre:</strong> {{ $provider->name }}</li>
                <li><strong>Correo Electrónico:</strong> {{ $provider->email }}</li>
                <li><strong>Número de RUC:</strong> {{ $provider->ruc_number }}</li>
                <li><strong>Dirección:</strong> {{ $provider->address }}</li>
                <li><strong>Teléfono:</strong> {{ $provider->phone }}</li>
            </ul>
        </div>
    </div>
@stop
