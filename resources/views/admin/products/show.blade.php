@extends('adminlte::page')

@section('title', 'Detalles del Producto')

@section('content_header')
    <h1>Detalles del Producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalles del Producto</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Detalles del Producto</h4>
                    <p><strong>ID:</strong> {{ $product->id }}</p>
                    <p><strong>Nombre:</strong> {{ $product->name }}</p>
                    <p><strong>Descripción:</strong> {{ $product->description }}</p>
                    <p><strong>Proveedor:</strong> {{ optional($product->provider)->name }}</p>
                    <p><strong>Categoría:</strong> {{ optional($product->category)->name }}</p>
                    <p><strong>Estado:</strong> {{ $product->status }}</p>
                </div>
                <div class="col-md-6">
                    <h4>Precios del Producto</h4>
                    @foreach ($product->prices as $price)
                        <p><strong>Precio total del lote:</strong> {{ $price->amount }}</p>
                        <p><strong>Precio Unitario:</strong> {{ $price->unit_price }}</p>
                        <p><strong>Moneda:</strong> {{ optional($price->currency)->name }}</p>
                        <p><strong>Descuento:</strong> {{ $price->discount }}</p>
                        <p><strong>Impuesto aplicado:</strong> {{ optional($price->tax)->name }}</p>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Imágenes del Producto</h4>
                    <td>
                    @foreach ($product->images as $image)
    <img src="{{ asset('storage/product_images/' . $image->image_path) }}" style="max-width: 800px;">
@endforeach

</td>


                </div>
            </div>
        </div>
    </div>
@stop
