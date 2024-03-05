@extends('adminlte::page')

@section('title', 'Lista de Productos')

@section('content_header')
    <h1>Lista de Productos</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Productos</h3>
        <div class="card-tools">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Crear Nuevo Producto</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Stock</th>
                    <th>Precio de Venta</th>
                    <th>Estado</th>
                    <th>Categoría</th>
                    <th>Proveedor</th>
                    <th>Imagen</th>
                    <th>Acciones</th> <!-- Columna para las acciones -->
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->sell_price }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->provider->name }}</td>
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100px;"></td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
