@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles</h3>
            <div class="card-tools">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Crear Nuevo Rol</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                @if ($role->image)
                                    <img src="{{ asset('images/roles/' . $role->image) }}" alt="{{ $role->name }}" style="max-width: 100px;">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este rol?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
