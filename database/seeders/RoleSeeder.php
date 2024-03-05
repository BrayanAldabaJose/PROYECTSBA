<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'client']);
    
        // Asignar todos los permisos al rol de administrador
        $adminRole->givePermissionTo(Permission::all());
    
        // Asignar permisos específicos al rol de usuario
        $userRole->givePermissionTo([
            'client.products.view',
            'client.products.quote',
            'client.products.reserve',
            'client.products.purchase',
        ]);
    }
}