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
                    @if ($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo"
                             class="img-thumbnail mt-2 rounded-circle" style="max-width: 200px;">
                    @endif

                    <!-- Agrega más campos del perfil según sea necesario -->
                    <div class="form-group">
                        <label for="updated_at">Updated At</label>
                        <input type="text" class="form-control" id="updated_at" name="updated_at"
                               value="{{ $user->updated_at }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="created_at">Created At</label>
                        <input type="text" class="form-control" id="created_at" name="created_at"
                               value="{{ $user->created_at }}" readonly>
                    </div>

                </div>
                <div class="box-footer">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Modificar</a>
                </div>
            </div>
        </div>
    </div>
@stop
