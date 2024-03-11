<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {


        $roles = Role::all();
        $permissions = Permission::all();


        $userRoles = $user->roles->pluck('name')->toArray();


        $userPermissions = $user->permissions->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'permissions', 'userRoles', 'userPermissions'));
    }

    public function update(Request $request, User $user)
    {
        // Validación de los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_photo_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Guardar el nombre antiguo antes de la actualización
        $oldName = $user->name;

        // Actualizar campos name y email
        $user->update($request->only('name', 'email'));

        // Actualizar foto de perfil si se proporciona
        if ($request->hasFile('profile_photo_path')) {
            // Eliminar la foto de perfil anterior si existe
            if ($user->profile_photo_path) {
                \Storage::delete('public/' . $user->profile_photo_path);
            }

            // Guardar la nueva foto de perfil
            $profilePhotoPath = $request->file('profile_photo_path')->store('profile-photos', 'public');
            $user->update(['profile_photo_path' => $profilePhotoPath]);
        }

        // Sincronizar roles y permisos
        $user->syncRoles($request->input('roles', []));
        $user->syncPermissions($request->input('permissions', []));

        // Loguear la actualización del nombre del usuario
        Log::info('Se actualizó el nombre del usuario de ' . $oldName . ' a ' . $user->name);

        // Loguear la actualización de roles y permisos usando ActivityLog
        activity()
            ->performedOn($user)
            ->withProperties(['roles' => $user->getRoleNames(), 'permissions' => $user->getPermissionNames()])
            ->log('Usuario actualizado');

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Resto del código...

    public function create()
    {
        // Acción para mostrar el formulario de creación
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Acción para procesar el formulario de creación
        // ...

        // Loguear la creación del usuario usando ActivityLog
        activity()
            ->withProperties(['name' => $request->input('name'), 'email' => $request->input('email')])
            ->log('Usuario creado');

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
    }
}
