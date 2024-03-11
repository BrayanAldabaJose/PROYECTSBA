@extends('adminlte::page')

@section('title', 'Crear Nuevo Rol')

@section('content_header')
    <h1>Crear Nuevo Rol</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Imagen:</label>
                    <input type="file" name="image" class="form-control-file">
                </div>

                <!-- Agrega aquí más campos según sea necesario -->

                <button type="submit" class="btn btn-success">Guardar Rol</button>
            </form>
        </div>

    </div>
@stop
