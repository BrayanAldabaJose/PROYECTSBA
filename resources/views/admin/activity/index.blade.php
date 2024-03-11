@extends('adminlte::page')

@section('title', 'Actividades de Usuarios')

@section('content_header')
    <h1 class="m-0 text-dark">Actividades de Usuarios</h1>

    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
   <link rel="stylesheet" href="{{ mix('css/custom-styles.css') }}">
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr>
                            <td>{{ $activity->created_at }}</td>
                            <td>{{ optional($activity->causer)->name }}</td>
                            <td>{{ $activity->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay actividades disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $activities->links() }}
    </div>
@stop
