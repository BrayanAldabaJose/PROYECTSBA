@extends('adminlte::page')

@section('title', 'Lista de Proveedores')

@section('content_header')
    <h1>Listado de Proveedores</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Proveedores</h3>
            <div class="card-tools">
                <a href="{{ route('providers.create') }}" class="btn btn-primary">Crear Proveedor</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Número de RUC</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <!-- Nuevos campos -->
                        <th>Tipo de cámaras</th>
                        <th>País de Origen</th>
                        <th>Países de Latinoamérica con oficinas</th>
                        <th>Link principal</th>
                        <!-- Fin de nuevos campos -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($providers as $provider)
                        <tr>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->email }}</td>
                            <td>{{ $provider->ruc_number }}</td>
                            <td>{{ $provider->address }}</td>
                            <td>{{ $provider->phone }}</td>
                            <!-- Nuevos campos -->
                            <td>{{ $provider->camera_type }}</td>
                            <td>{{ $provider->origin_country }}</td>
                            <td>{{ $provider->latin_american_countries }}</td>
                            <td>{{ $provider->main_link }}</td>
                            <!-- Fin de nuevos campos -->
                            <td>
                                <a href="{{ route('providers.show', $provider->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('providers.edit', $provider->id) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('providers.destroy', $provider->id) }}" method="POST" style="display: inline;">
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
