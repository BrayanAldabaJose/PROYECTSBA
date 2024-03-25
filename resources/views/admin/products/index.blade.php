@extends('adminlte::page')

@section('title', 'Lista de Productos')

@section('content_header')
    <h1>Lista de Productos</h1>
    <!-- Enlace a tus estilos personalizados compilados con Vite -->
    <link rel="stylesheet" href="@vite('resources/css/custom-styles-product.css')">
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Productos</h3>
            <div class="card-tools">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Crear Nuevo Producto</a>
            </div>
            <form action="{{ route('products.search') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Buscar productos...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">Buscar</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th>ID:</th>
                            <td>{{ $product->id }}</td>
                            <th>Nombre:</th>
                            <td>{{ $product->name }}</td>
                            <th>Marca:</th>
                            <td>{{ optional($product->provider)->name }}</td>
                            <th>Categoría:</th>
                            <td>{{ optional($product->category)->name }}</td>
                            <th>Estado:</th>
                            <td>{{ $product->status }}</td>
                            <td>
    @if ($product->images !== null)
    @foreach ($product->images as $image)
    <img src="{{ asset('storage/product_images/' . $image->image_path) }}" style="max-width: 800px;">
@endforeach

    @endif
</td>

                            <th>Stock inicial:</th>
                            <td>{{ $product->initial_stock }}</td>
                            <th>Stock actual:</th>
                            <td>{{ $product->current_stock }}</td>
                            <th>Acciones:</th>
                            <td>


                                <!-- Botón Editar -->
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editar</a>
                                <!-- Formulario Eliminar -->
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                <!-- Botón Ver -->
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Ver</a>
                            </td>
                        </tr>
                        <!-- Mostrar los precios asociados al producto -->
<!-- Mostrar los precios asociados al producto -->
@foreach ($product->prices as $price)
    <tr>
        <th>Precio total del lote:</th>
        <td>{{ $price->amount }}</td>
        <th>Precio Unitario:</th>
        <td>{{ $price->unit_price }}</td>
        <th>Tipo de moneda de cambio:</th>
        <td>{{ optional($price->currency)->name }}</td> <!-- Accede al nombre de la moneda -->
        <th>Precio base:</th>
        <td>{{ $price->base_price }}</td> <!-- Corregido para acceder al precio base -->
        <th>Descuento:</th>
        <td>{{ $price->discount }}%</td> <!-- Muestra el porcentaje de descuento -->
        <th>Impuesto aplicado:</th>
        <td>{{ optional($price->tax)->name }}</td> <!-- Accede al nombre del impuesto aplicado -->
    </tr>
@endforeach


                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
