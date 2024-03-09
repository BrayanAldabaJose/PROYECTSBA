<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role; // Importa el modelo Role
use Spatie\Permission\Models\Permission; // Importa el modelo Permission

class UserController extends Controller
{
    public function index()
{
    $users = User::all();
    return view('admin.users.index', compact('users'));
}

    public function edit(User $user)
    {
        // Obtener todos los roles y permisos disponibles
        $roles = Role::all();
        $permissions = Permission::all();

        // Obtener los roles asignados al usuario
        $userRoles = $user->roles->pluck('name')->toArray();

        // Obtener los permisos asignados al usuario
        $userPermissions = $user->permissions->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'permissions', 'userRoles', 'userPermissions'));
    }

    public function update(Request $request, User $user)
    {
        // Actualizar los datos del usuario
        $user->update($request->only('name', 'email'));

        // Actualizar roles y permisos asignados al usuario
        $user->syncRoles($request->input('roles', []));
        $user->syncPermissions($request->input('permissions', []));

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }


}
