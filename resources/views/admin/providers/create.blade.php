@extends('adminlte::page')

@section('title', 'Crear Proveedor')

@section('content_header')
    <h1>Crear Proveedor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('providers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="ruc_number">Número de RUC:</label>
                    <input type="text" name="ruc_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Dirección:</label>
                    <input type="text" name="address" class="form-control">
                </div>


                <div class="form-group">
                    <label for="phone">Teléfono:</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <!-- Nuevos campos -->
                <div class="form-group">
                    <label for="camera_type">Tipo de cámaras:</label>
                    <input type="text" name="camera_type" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="origin_country">País de Origen:</label>
                    <input type="text" name="origin_country" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="latin_american_countries">Países de Latinoamérica con oficinas:</label>
                    <input type="text" name="latin_american_countries" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="main_link">Link principal:</label>
                    <input type="url" name="main_link" class="form-control" required>
                </div>
                <!-- Fin de nuevos campos -->
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>

        </div>
    </div>
@stop
