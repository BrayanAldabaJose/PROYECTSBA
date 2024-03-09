@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Rol</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea name="description" id="description" class="form-control" required>{{ $role->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Imagen:</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Rol</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <!-- Formulario para eliminar el rol -->
            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar Rol</button>
            </form>
        </div>
    </div>
@endsection
