@extends('adminlte::page')

@section('title', 'Editar Proveedor')

@section('content_header')
    <h1>Editar Proveedor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('providers.update', $provider->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ $provider->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ $provider->email }}" required>
                </div>
                <div class="form-group">
                    <label for="ruc_number">Número de RUC</label>
                    <input type="text" name="ruc_number" class="form-control" value="{{ $provider->ruc_number }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ $provider->address }}">
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ $provider->phone }}" required>
                </div>
                <!-- Nuevos campos -->
                <div class="form-group">
                    <label for="camera_type">Tipo de cámaras</label>
                    <input type="text" name="camera_type" class="form-control" value="{{ $provider->camera_type }}" required>
                </div>
                <div class="form-group">
                    <label for="origin_country">País de Origen</label>
                    <input type="text" name="origin_country" class="form-control" value="{{ $provider->origin_country }}" required>
                </div>
                <div class="form-group">
                    <label for="latin_american_countries">Países de Latinoamérica con oficinas</label>
                    <input type="text" name="latin_american_countries" class="form-control" value="{{ $provider->latin_american_countries }}" required>
                </div>
                <div class="form-group">
                    <label for="main_link">Link principal</label>
                    <input type="url" name="main_link" class="form-control" value="{{ $provider->main_link }}" required>
                </div>
                <!-- Fin de nuevos campos -->
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
@stop
