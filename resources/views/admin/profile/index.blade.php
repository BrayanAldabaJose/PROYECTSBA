@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <p><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <!-- Otros campos del perfil que desees mostrar -->
                </div>
                <div class="box-footer">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Modificar</a>
                </div>
            </div>
        </div>
    </div>
@stop
