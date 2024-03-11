@extends('adminlte::page')

@section('title', 'Detalle del Proveedor')

@section('content_header')
    <h1>Detalle del Proveedor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nombre:</th>
                    <td>{{ $provider->name }}</td>
                </tr>
                <tr>
                    <th>Correo Electrónico:</th>
                    <td>{{ $provider->email }}</td>
                </tr>
                <tr>
                    <th>Número de RUC:</th>
                    <td>{{ $provider->ruc_number }}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{{ $provider->address }}</td>
                </tr>
                <tr>
                    <th>Teléfono:</th>
                    <td>{{ $provider->phone }}</td>
                </tr>
                <!-- Nuevos campos -->
                <tr>
                    <th>Tipo de cámaras:</th>
                    <td>{{ $provider->camera_type }}</td>
                </tr>
                <tr>
                    <th>País de Origen:</th>
                    <td>{{ $provider->origin_country }}</td>
                </tr>
                <tr>
                    <th>Países de Latinoamérica con oficinas:</th>
                    <td>{{ $provider->latin_american_countries }}</td>
                </tr>
                <tr>
                    <th>Link principal:</th>
                    <td>{{ $provider->main_link }}</td>
                </tr>
                <!-- Fin de nuevos campos -->
            </table>
            <a href="{{ route('providers.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@stop
