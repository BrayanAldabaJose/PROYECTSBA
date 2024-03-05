@extends('adminlte::page')

@section('title', 'Detalles de Categoría')

@section('content_header')
    <h1>{{ $category->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p><strong>Descripción:</strong> {{ $category->description }}</p>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@stop
