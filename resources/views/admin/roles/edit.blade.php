@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <h1>Editar Rol</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea name="description" class="form-control" required>{{ $role->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Imagen:</label>
                    <input type="file" name="image" class="form-control-file">
                </div>

                <!-- Agrega aquí más campos según sea necesario -->

                <button type="submit" class="btn btn-primary">Actualizar Rol</button>
            </form>
        </div>


    </div>
@stop
