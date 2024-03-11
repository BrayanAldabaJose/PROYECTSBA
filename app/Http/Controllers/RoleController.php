<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function actualizarRoles()
    {
        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);
        return redirect()->route('roles.index')->with('success', 'Roles actualizados exitosamente.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/roles'), $imageName);
            $role->image = $imageName;
        }

        $role->save();

        return redirect()->route('admin.roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Otros campos de validación según tu lógica
        ]);

        try {
            // Actualizar usuario
            $user->update($request->only('name', 'email'));

            // Actualizar foto de perfil si se proporciona
            // ...

            // Sincronizar roles y permisos
            $rolesInput = $request->input('roles', []);
            $permissionsInput = $request->input('permissions', []);

            // Verificar si los roles y permisos existen antes de sincronizarlos
            $existingRoles = Role::whereIn('name', $rolesInput)->get();
            $existingPermissions = Permission::whereIn('name', $permissionsInput)->get();

            $user->syncRoles($existingRoles);
            $user->syncPermissions($existingPermissions);

            // Loguear la actualización del nombre del usuario y otros registros según tu lógica
            // ...

            return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejar la excepción (puedes loguearla, redirigir a una página de error, etc.)
            return redirect()->back()->with('error', 'Ocurrió un error al sincronizar roles y permisos.');
        }
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
