@extends('adminlte::page')

@section('title', 'Detalles del Producto')

@section('content_header')
    <h1>Detalles del Producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $product->name }}</p>
            <p><strong>Precio de Venta:</strong> {{ $product->sell_price }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <!-- Agrega más detalles según tus necesidades -->
            <a href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@endsection
