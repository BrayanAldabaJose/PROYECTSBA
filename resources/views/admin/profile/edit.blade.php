@extends('adminlte::page')

@section('title', 'Edit Profile')

@section('content_header')
    <h1>Edit Profile</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Formulario de edición aquí -->
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <!-- Enlace para ir a la página de cambio de contraseña -->
                <div class="form-group">
                    <a href="{{ route('profile.updatePasswordView') }}">Change Password</a>
                </div>

                <!-- Otros campos del perfil que desees editar -->

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
@stop
